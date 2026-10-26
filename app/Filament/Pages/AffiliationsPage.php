<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AffiliationsPage extends Page
{
    protected string $view = 'filament.pages.affiliations';

    public function getTitle(): string { return 'Afiliaciones'; }
    public static function getNavigationLabel(): string { return 'Afiliaciones'; }
    public static function getNavigationIcon(): string { return 'heroicon-o-users'; }

    public $subscriptions;
    public $tenants;
    public $plans;
    public $expandedRow = null;
    public $expandedServices = [];

    // Modal nueva afiliación
    public bool $showCreateModal = false;
    public bool $showDeleteModal = false;
    public ?int $deletingId = null;

    public string $form_tenant_id = '';
    public string $form_plan_id = '';
    public array  $form_plan_services = [];
    public string $form_start_date = '';
    public string $form_end_date = '';
    public bool   $form_auto_renew = false;
    public string $form_subtotal = '';
    public string $form_discount = '0';
    public string $form_tax = '0';
    public string $form_total = '';
    public string $form_payment_method = '';
    public string $form_payment_reference = '';
    public string $form_payment_date = '';
    public string $form_status = 'active';
    public array  $formErrors = [];

    public function mount(): void
    {
        $this->tenants = DB::table('tenants')->where('status', 1)->orderBy('name')->get();
        $this->plans   = DB::table('plans')->where('is_active', 1)->orderBy('name')->get();
        $this->loadSubscriptions();
    }

    public function loadSubscriptions(): void
    {
        $this->subscriptions = DB::table('subscriptions as s')
            ->join('tenants as t', 's.tenant_id', '=', 't.id')
            ->join('plans as p', 's.plan_id', '=', 'p.id')
            ->select(
                's.id',
                's.reference',
                's.tenant_id',
                's.plan_id',
                's.start_date',
                's.end_date',
                's.status',
                's.auto_renew',
                's.subtotal',
                's.discount',
                's.tax',
                's.total',
                's.created_at',
                't.name as tenant_name',
                't.email as tenant_email',
                't.phone as tenant_phone',
                'p.name as plan_name',
                'p.price as plan_price',
                'p.billing_period'
            )
            ->orderBy('s.created_at', 'desc')
            ->get();
    }

    public function updatedFormPlanId(): void
    {
        if (!$this->form_plan_id) {
            $this->form_plan_services = [];
            return;
        }
        $this->form_plan_services = DB::table('plan_services as ps')
            ->join('services as s', 'ps.service_id', '=', 's.id')
            ->where('ps.plan_id', $this->form_plan_id)
            ->pluck('s.name')
            ->toArray();

        $plan = DB::table('plans')->where('id', $this->form_plan_id)->first();
        if ($plan && !$this->form_subtotal) {
            $this->form_subtotal = (string) $plan->price;
            $this->recalcTotal();
        }
    }

    public function updatedFormSubtotal(): void { $this->recalcTotal(); }
    public function updatedFormDiscount(): void  { $this->recalcTotal(); }
    public function updatedFormTax(): void        { $this->recalcTotal(); }

    private function recalcTotal(): void
    {
        $subtotal = (float)($this->form_subtotal ?: 0);
        $discount = (float)($this->form_discount ?: 0);
        $tax      = (float)($this->form_tax ?: 0);
        $this->form_total = (string) round($subtotal - $discount + ($subtotal * $tax / 100), 2);
    }

    public function openCreateModal(): void
    {
        $this->form_tenant_id        = '';
        $this->form_plan_id          = '';
        $this->form_plan_services    = [];
        $this->form_start_date       = now()->format('Y-m-d');
        $this->form_end_date         = '';
        $this->form_auto_renew       = false;
        $this->form_subtotal         = '';
        $this->form_discount         = '0';
        $this->form_tax              = '0';
        $this->form_total            = '';
        $this->form_payment_method   = '';
        $this->form_payment_reference = '';
        $this->form_payment_date     = now()->format('Y-m-d');
        $this->form_status           = 'active';
        $this->formErrors            = [];
        $this->showCreateModal       = true;
    }

    public function closeModal(): void
    {
        $this->showCreateModal = false;
        $this->showDeleteModal = false;
        $this->formErrors      = [];
    }

    public function createSubscription(): void
    {
        $this->formErrors = [];

        if (!$this->form_tenant_id)    $this->formErrors['tenant_id']   = 'Selecciona una empresa.';
        if (!$this->form_plan_id)      $this->formErrors['plan_id']     = 'Selecciona un plan.';
        if (!$this->form_start_date)   $this->formErrors['start_date']  = 'La fecha de inicio es obligatoria.';
        if (!$this->form_end_date)     $this->formErrors['end_date']    = 'La fecha de fin es obligatoria.';
        if (!$this->form_total)        $this->formErrors['total']       = 'El total es obligatorio.';

        if (!empty($this->formErrors)) return;

        $now       = now();
        $reference = 'SUB-' . strtoupper(Str::random(8));

        $subscriptionId = DB::table('subscriptions')->insertGetId([
            'reference'   => $reference,
            'tenant_id'   => $this->form_tenant_id,
            'plan_id'     => $this->form_plan_id,
            'start_date'  => $this->form_start_date,
            'end_date'    => $this->form_end_date,
            'status'      => $this->form_status,
            'auto_renew'  => $this->form_auto_renew ? 1 : 0,
            'subtotal'    => $this->form_subtotal ?: 0,
            'discount'    => $this->form_discount ?: 0,
            'tax'         => $this->form_tax ?: 0,
            'total'       => $this->form_total,
            'created_at'  => $now,
            'updated_at'  => $now,
        ]);

        // Crear subscription_services por cada servicio del plan
        $services = DB::table('plan_services')->where('plan_id', $this->form_plan_id)->get();
        foreach ($services as $ps) {
            DB::table('subscription_services')->insert([
                'subscription_id' => $subscriptionId,
                'service_id'      => $ps->service_id,
                'status'          => $this->form_status === 'active' ? 'active' : 'inactive',
                'activated_at'    => $this->form_status === 'active' ? $now : null,
                'created_at'      => $now,
                'updated_at'      => $now,
            ]);
        }

        // Registrar pago si se ingresó
        if ($this->form_total && $this->form_payment_date) {
            $paymentRef = 'PAY-' . strtoupper(Str::random(8));
            $paymentId  = DB::table('payments')->insertGetId([
                'reference'             => $paymentRef,
                'tenant_id'             => $this->form_tenant_id,
                'payment_date'          => $this->form_payment_date,
                'total_amount'          => $this->form_total,
                'currency'              => 'COP',
                'status'                => 'completed',
                'payment_method'        => $this->form_payment_method ?: null,
                'transaction_reference' => $this->form_payment_reference ?: null,
                'created_at'            => $now,
                'updated_at'            => $now,
            ]);

            DB::table('payment_allocations')->insert([
                'payment_id'      => $paymentId,
                'subscription_id' => $subscriptionId,
                'amount'          => $this->form_total,
                'created_at'      => $now,
                'updated_at'      => $now,
            ]);
        }

        // Activar usuarios del tenant si la suscripción es activa
        if ($this->form_status === 'active') {
            DB::table('users')->where('tenant_id', $this->form_tenant_id)
                ->update(['active' => 1, 'status' => '1', 'updated_at' => $now]);
        }

        $this->closeModal();
        $this->loadSubscriptions();
    }

    public function toggleStatus(int $id): void
    {
        $sub    = DB::table('subscriptions')->where('id', $id)->first();
        $new    = $sub->status === 'active' ? 'inactive' : 'active';
        $now    = now();

        DB::table('subscriptions')->where('id', $id)->update(['status' => $new, 'updated_at' => $now]);
        DB::table('subscription_services')->where('subscription_id', $id)->update([
            'status'          => $new === 'active' ? 'active' : 'inactive',
            'activated_at'    => $new === 'active' ? $now : null,
            'deactivated_at'  => $new === 'inactive' ? $now : null,
            'updated_at'      => $now,
        ]);

        DB::table('users')->where('tenant_id', $sub->tenant_id)
            ->update(['active' => $new === 'active' ? 1 : 0, 'status' => $new === 'active' ? '1' : '0', 'updated_at' => $now]);

        $this->loadSubscriptions();
    }

    public function confirmDelete(int $id): void
    {
        $this->deletingId     = $id;
        $this->showDeleteModal = true;
    }

    public function delete(): void
    {
        if (!$this->deletingId) return;
        DB::table('subscription_services')->where('subscription_id', $this->deletingId)->delete();
        DB::table('payment_allocations')->where('subscription_id', $this->deletingId)->delete();
        DB::table('subscriptions')->where('id', $this->deletingId)->delete();
        $this->showDeleteModal = false;
        $this->deletingId      = null;
        $this->loadSubscriptions();
    }

    public function toggleExpand(int $id): void
    {
        if ($this->expandedRow === $id) {
            $this->expandedRow     = null;
            $this->expandedServices = [];
        } else {
            $this->expandedRow      = $id;
            $this->expandedServices = DB::table('subscription_services as ss')
                ->join('services as s', 'ss.service_id', '=', 's.id')
                ->where('ss.subscription_id', $id)
                ->select('s.name', 'ss.status', 'ss.activated_at', 'ss.deactivated_at')
                ->get()
                ->toArray();
        }
    }
}
