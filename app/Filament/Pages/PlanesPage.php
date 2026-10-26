<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PlanesPage extends Page
{
    public static function getNavigationIcon(): string { return 'heroicon-o-rectangle-stack'; }
    protected string $view = 'filament.pages.planes';
    protected static ?string $navigationLabel = 'Planes';
    protected static ?string $title = 'Planes';
    public static function getNavigationGroup(): ?string { return 'Gestión'; }
    protected static ?int $navigationSort = 6;

    public array $plans = [];
    public array $services = [];
    public bool $showModal = false;
    public bool $showDeleteModal = false;
    public ?int $editingId = null;
    public ?int $deletingId = null;

    public string $name = '';
    public string $planSlug = '';
    public string $description = '';
    public string $price = '';
    public string $currency = 'COP';
    public string $billing_period = 'annual';
    public string $is_active = '1';
    public array $selectedServices = [];
    public array $formErrors = [];

    public function mount(): void
    {
        $this->loadPlans();
        $this->services = DB::table('services')->where('is_active', 1)->orderBy('name')->get()->toArray();
    }

    public function loadPlans(): void
    {
        $this->plans = DB::table('plans')->orderBy('id')->get()->map(function ($plan) {
            $plan->services = DB::table('plan_services')
                ->join('services', 'plan_services.service_id', '=', 'services.id')
                ->where('plan_services.plan_id', $plan->id)
                ->pluck('services.name')
                ->toArray();
            return $plan;
        })->toArray();
    }

    public function openCreate(): void
    {
        $this->editingId = null;
        $this->name = $this->planSlug = $this->description = $this->price = '';
        $this->currency = 'COP';
        $this->billing_period = 'annual';
        $this->is_active = '1';
        $this->selectedServices = [];
        $this->formErrors = [];
        $this->showModal = true;
    }

    public function openEdit(int $id): void
    {
        $row = collect($this->plans)->firstWhere('id', $id);
        if (!$row) return;
        $this->editingId         = $id;
        $this->name              = $row->name ?? '';
        $this->planSlug          = $row->slug ?? '';
        $this->description       = $row->description ?? '';
        $this->price             = (string)($row->price ?? '');
        $this->currency          = $row->currency ?? 'COP';
        $this->billing_period    = $row->billing_period ?? 'annual';
        $this->is_active         = (string)($row->is_active ?? '1');
        $this->selectedServices  = DB::table('plan_services')->where('plan_id', $id)->pluck('service_id')->map(fn($v) => (string)$v)->toArray();
        $this->formErrors        = [];
        $this->showModal         = true;
    }

    public function updatedName(): void
    {
        if (!$this->editingId) {
            $this->planSlug = Str::slug($this->name);
        }
    }

    public function save(): void
    {
        $this->formErrors = [];
        if (trim($this->name) === '')        $this->formErrors['name']  = 'El nombre es obligatorio.';
        if (trim($this->price) === '')       $this->formErrors['price'] = 'El precio es obligatorio.';
        elseif (!is_numeric($this->price))   $this->formErrors['price'] = 'El precio debe ser numérico.';
        if (!empty($this->formErrors)) return;

        if (!$this->planSlug) $this->planSlug = Str::slug($this->name);

        $now  = now();
        $data = [
            'name'           => $this->name,
            'slug'           => $this->planSlug,
            'description'    => $this->description,
            'price'          => $this->price,
            'currency'       => $this->currency,
            'billing_period' => $this->billing_period,
            'is_active'      => $this->is_active,
            'updated_at'     => $now,
        ];

        if ($this->editingId) {
            DB::table('plans')->where('id', $this->editingId)->update($data);
            $planId = $this->editingId;
            DB::table('plan_services')->where('plan_id', $planId)->delete();
        } else {
            $planId = DB::table('plans')->insertGetId(array_merge($data, ['created_at' => $now]));
        }

        foreach ($this->selectedServices as $serviceId) {
            DB::table('plan_services')->insert(['plan_id' => $planId, 'service_id' => (int)$serviceId]);
        }

        $this->showModal = false;
        $this->loadPlans();
    }

    public function confirmDelete(int $id): void
    {
        $this->deletingId = $id;
        $this->showDeleteModal = true;
    }

    public function delete(): void
    {
        if (!$this->deletingId) return;
        DB::table('plans')->where('id', $this->deletingId)->delete();
        $this->showDeleteModal = false;
        $this->deletingId = null;
        $this->loadPlans();
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->showDeleteModal = false;
        $this->formErrors = [];
    }
}
