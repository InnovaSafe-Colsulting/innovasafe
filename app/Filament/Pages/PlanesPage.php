<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\DB;

class PlanesPage extends Page
{
    public static function getNavigationIcon(): string { return 'heroicon-o-rectangle-stack'; }
    protected string $view = 'filament.pages.planes';
    protected static ?string $navigationLabel = 'Planes';
    protected static ?string $title = 'Planes';
    public static function getNavigationGroup(): ?string { return 'Gestión'; }
    protected static ?int $navigationSort = 6;

    public array $plans = [];
    public bool $showModal = false;
    public bool $showDeleteModal = false;
    public ?int $editingId = null;
    public ?int $deletingId = null;

    public string $name = '';
    public string $description = '';
    public string $access = '';
    public string $prize = '';
    public string $basic_modules = '';
    public string $additional_modules = '';
    public string $discount = '0';
    public string $status = '1';
    public array $formErrors = [];

    public function mount(): void
    {
        $this->loadPlans();
    }

    public function loadPlans(): void
    {
        $this->plans = DB::table('plans')->orderBy('id')->get()->toArray();
    }

    public function openCreate(): void
    {
        $this->editingId = null;
        $this->name = $this->description = $this->access = $this->prize = '';
        $this->basic_modules = $this->additional_modules = '1';
        $this->discount = '0';
        $this->status = '1';
        $this->formErrors = [];
        $this->showModal = true;
    }

    public function openEdit(int $id): void
    {
        $row = collect($this->plans)->firstWhere('id', $id);
        if (!$row) return;
        $this->editingId         = $id;
        $this->name              = $row->name ?? '';
        $this->description       = $row->description ?? '';
        $this->access            = (string)($row->access ?? '');
        $this->prize             = (string)($row->prize ?? '');
        $this->basic_modules     = $row->basic_modules ?? '';
        $this->additional_modules = $row->additional_modules ?? '';
        $this->discount          = (string)($row->discount ?? '0');
        $this->status            = (string)($row->status ?? '1');
        $this->formErrors        = [];
        $this->showModal         = true;
    }

    public function save(): void
    {
        $this->formErrors = [];
        if (trim($this->name) === '')          $this->formErrors['name']   = 'El nombre es obligatorio.';
        if (trim($this->prize) === '')         $this->formErrors['prize']  = 'El precio es obligatorio.';
        elseif (!is_numeric($this->prize))     $this->formErrors['prize']  = 'El precio debe ser numérico.';
        if ($this->access !== '' && !is_numeric($this->access))     $this->formErrors['access']   = 'El acceso debe ser numérico.';
        if ($this->discount !== '' && !is_numeric($this->discount)) $this->formErrors['discount'] = 'El descuento debe ser numérico.';
        if (!empty($this->formErrors)) return;

        $now = now();
        $data = [
            'name'               => $this->name,
            'description'        => $this->description,
            'access'             => $this->access ?: null,
            'prize'              => $this->prize,
            'basic_modules'      => $this->basic_modules,
            'additional_modules' => $this->additional_modules,
            'discount'           => $this->discount ?: 0,
            'status'             => $this->status,
            'updated_at'         => $now,
        ];

        if ($this->editingId) {
            DB::table('plans')->where('id', $this->editingId)->update($data);
        } else {
            DB::table('plans')->insert(array_merge($data, ['created_at' => $now]));
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
