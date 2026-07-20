<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use UnitEnum;

class ServiciosPorUsuarioPage extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    protected string $view = 'filament.pages.servicios-por-usuario';

    protected static ?string $navigationLabel = 'Servicios Por Usuario';

    protected static ?string $title = 'Servicios Por Usuario';

    protected static string|UnitEnum|null $navigationGroup = 'Gestión';

    protected static ?int $navigationSort = 6;

    public array $records        = [];
    public array $users          = [];
    public array $plans          = [];
    public array $paymentStatuses = [];
    public array $typeServices   = [];
    public array $typePayments   = [];

    // Form
    public bool    $showModal         = false;
    public bool    $showEditModal     = false;
    public bool    $showDeleteModal   = false;
    public ?int    $editingId         = null;
    public ?int    $deletingId        = null;
    public ?int    $user_id           = null;
    public ?int    $plan_id           = null;
    public ?int    $payment_status_id = null;
    public ?int    $type_service_id   = null;
    public ?int    $payment_type_id   = null;
    public string  $payment_date      = '';
    public string  $billing_period    = 'monthly';
    public string  $expires_at        = '';
    public string  $status            = 'active';
    public array   $formErrors        = [];
    public ?string $uploadedProof     = null;
    public ?string $currentProof      = null;

    public function mount(): void
    {
        $this->loadRecords();
    }

    public function loadRecords(): void
    {
        $this->records = DB::table('user_services as us')
            ->leftJoin('contacts as c', 'c.id', '=', 'us.contact_id')
            ->join('plans as p', 'p.id', '=', 'us.plan_id')
            ->join('orders as o', 'o.id', '=', 'us.order_id')
            ->leftJoin('payment_status as ps', 'ps.id', '=', 'us.payment_status_id')
            ->leftJoin('type_services as ts', 'ts.id', '=', 'us.type_service_id')
            ->leftJoin('type_payment as tp', 'tp.id', '=', 'us.payment_type_id')
            ->select(
                'us.id',
                'us.status',
                'us.billing_period',
                'us.payment_date',
                'us.expires_at',
                'c.names as user_names',
                'c.last_names as user_last_names',
                'c.email as user_email',
                'p.name as plan_name',
                'o.id as order_id',
                'ps.name as payment_status_name',
                'ps.color as payment_status_color',
                'ts.name as service_name',
                'tp.name as payment_type_name'
            )
            ->orderByDesc('us.created_at')
            ->get()
            ->toArray();
    }

    public function openCreate(): void
    {
        $this->loadSelectData();

        $this->user_id           = null;
        $this->plan_id           = null;
        $this->payment_status_id = null;
        $this->type_service_id   = null;
        $this->payment_type_id   = null;
        $this->payment_date      = '';
        $this->billing_period    = 'monthly';
        $this->expires_at        = '';
        $this->status            = 'active';
        $this->uploadedProof     = null;
        $this->currentProof      = null;
        $this->formErrors        = [];
        $this->showModal         = true;
    }

    private function loadSelectData(): void
    {
        $this->users = DB::table('contacts')
            ->select('id', 'names', 'last_names', 'email')
            ->orderBy('names')
            ->get()->toArray();

        $this->plans = DB::table('plans')
            ->select('id', 'name', 'prize')
            ->where('status', 1)
            ->orderBy('name')
            ->get()->toArray();

        $this->paymentStatuses = DB::table('payment_status')
            ->select('id', 'name')
            ->orderBy('name')
            ->get()->toArray();

        $this->typeServices = DB::table('type_services')
            ->select('id', 'name')
            ->where('status', 1)
            ->orderBy('name')
            ->get()->toArray();

        $this->typePayments = DB::table('type_payment')
            ->select('id', 'name')
            ->where('status', 1)
            ->orderBy('name')
            ->get()->toArray();
    }

    public function save(): void
    {
        $this->formErrors = [];

        if (!$this->user_id)           $this->formErrors['user_id']         = 'El contacto es obligatorio.';
        if (!$this->plan_id)           $this->formErrors['plan_id']         = 'El plan es obligatorio.';
        if (!$this->payment_type_id)   $this->formErrors['payment_type_id'] = 'El tipo de pago es obligatorio.';
        if (!$this->payment_date)      $this->formErrors['payment_date']    = 'La fecha de pago es obligatoria.';
        if (!$this->expires_at)        $this->formErrors['expires_at']      = 'La fecha de expiración es obligatoria.';

        if (!empty($this->formErrors)) return;

        // 1. Buscar o crear user desde contact
        $contact = DB::table('contacts')->where('id', $this->user_id)->first();
        $existingUser = DB::table('users')->where('email', $contact->email)->first();

        if ($existingUser) {
            $userId = $existingUser->id;
        } else {
            $userId = DB::table('users')->insertGetId([
                'names'      => $contact->names,
                'last_names' => $contact->last_names,
                'email'      => $contact->email,
                'cellphone'  => $contact->cellphone ?? null,
                'password'   => bcrypt('Innovasafe' . now()->year . '*'),
                'role_id'    => 3,
                'city_id'    => 1,
                'status'     => '1',
                'active'     => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 2. Crear cart
        $cartId = DB::table('carts')->insertGetId([
            'user_id'    => $userId,
            'status'     => 'completed',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3. Calcular montos desde el plan
        $plan     = DB::table('plans')->where('id', $this->plan_id)->first();
        $subtotal = (float) $plan->prize;
        $iva      = round($subtotal * 0.19, 2);
        $total    = round($subtotal + $iva, 2);

        // 4. Mapear payment_status a order status
        $paymentStatus = DB::table('payment_status')->where('id', $this->payment_status_id)->first();
        $orderStatus = 'cancelled';
        if ($paymentStatus) {
            if ($paymentStatus->name === 'Pago Exitoso')   $orderStatus = 'paid';
            if ($paymentStatus->name === 'Pago Pendiente') $orderStatus = 'pending';
        }

        // 5. Generar order_number
        $lastOrder   = DB::table('orders')->orderByDesc('id')->first();
        $nextNum     = $lastOrder ? ($lastOrder->id + 1) : 1;
        $orderNumber = 'ORD-' . str_pad($nextNum, 6, '0', STR_PAD_LEFT);

        // 6. Ruta del comprobante (subido previamente via fetch)
        $proofPath = $this->uploadedProof;

        // 7. Crear order
        $orderId = DB::table('orders')->insertGetId([
            'user_id'         => $userId,
            'cart_id'         => $cartId,
            'order_number'    => $orderNumber,
            'payment_type_id' => $this->payment_type_id,
            'payment_proof'   => $proofPath,
            'subtotal'        => $subtotal,
            'iva'             => $iva,
            'total'           => $total,
            'status'          => $orderStatus,
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);

        // 8. Crear user_service
        DB::table('user_services')->insert([
            'contact_id'        => $this->user_id,
            'plan_id'           => $this->plan_id,
            'order_id'          => $orderId,
            'payment_status_id' => $this->payment_status_id ?: null,
            'type_service_id'   => $this->type_service_id ?: null,
            'payment_type_id'   => $this->payment_type_id,
            'payment_date'      => $this->payment_date,
            'billing_period'    => $this->billing_period,
            'expires_at'        => $this->expires_at,
            'status'            => $this->status,
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        $this->showModal = false;
        $this->loadRecords();
        $this->dispatch('spu-toast', message: 'Registro creado exitosamente.', type: 'success');
    }

    public function openEdit(int $id): void
    {
        $this->loadSelectData();

        $record = DB::table('user_services')->where('id', $id)->first();

        $this->editingId         = $id;
        $this->user_id           = $record->contact_id;
        $this->plan_id           = $record->plan_id;
        $this->payment_status_id = $record->payment_status_id;
        $this->type_service_id   = $record->type_service_id;
        $this->payment_type_id   = $record->payment_type_id;
        $this->payment_date      = $record->payment_date ?? '';
        $this->billing_period    = $record->billing_period ?? 'monthly';
        $this->expires_at        = $record->expires_at ?? '';
        $this->status            = $record->status ?? 'active';
        $this->currentProof      = $record->payment_proof ?? null;
        $this->uploadedProof     = null;
        $this->formErrors        = [];
        $this->showEditModal     = true;
    }

    public function update(): void
    {
        $this->formErrors = [];

        if (!$this->user_id)         $this->formErrors['user_id']         = 'El contacto es obligatorio.';
        if (!$this->plan_id)         $this->formErrors['plan_id']         = 'El plan es obligatorio.';
        if (!$this->payment_type_id) $this->formErrors['payment_type_id'] = 'El tipo de pago es obligatorio.';
        if (!$this->payment_date)    $this->formErrors['payment_date']    = 'La fecha de pago es obligatoria.';
        if (!$this->expires_at)      $this->formErrors['expires_at']      = 'La fecha de expiración es obligatoria.';

        if (!empty($this->formErrors)) return;

        $proof = $this->uploadedProof ?? $this->currentProof;

        DB::table('user_services')->where('id', $this->editingId)->update([
            'contact_id'        => $this->user_id,
            'plan_id'           => $this->plan_id,
            'payment_status_id' => $this->payment_status_id ?: null,
            'type_service_id'   => $this->type_service_id ?: null,
            'payment_type_id'   => $this->payment_type_id,
            'payment_date'      => $this->payment_date,
            'billing_period'    => $this->billing_period,
            'expires_at'        => $this->expires_at,
            'status'            => $this->status,
            'updated_at'        => now(),
        ]);

        // Actualizar también la order asociada si cambió el estado de pago
        $record = DB::table('user_services')->where('id', $this->editingId)->first();
        if ($record && $record->order_id) {
            $paymentStatus = DB::table('payment_status')->where('id', $this->payment_status_id)->first();
            $orderStatus = 'cancelled';
            if ($paymentStatus) {
                if ($paymentStatus->name === 'Pago Exitoso')   $orderStatus = 'paid';
                if ($paymentStatus->name === 'Pago Pendiente') $orderStatus = 'pending';
            }
            DB::table('orders')->where('id', $record->order_id)->update([
                'payment_type_id' => $this->payment_type_id,
                'payment_proof'   => $proof,
                'status'          => $orderStatus,
                'updated_at'      => now(),
            ]);
        }

        $this->showEditModal = false;
        $this->loadRecords();
        $this->dispatch('spu-toast', message: 'Registro actualizado exitosamente.', type: 'success');
    }

    public function confirmDelete(int $id): void
    {
        $this->deletingId      = $id;
        $this->showDeleteModal = true;
    }

    public function delete(): void
    {
        DB::table('user_services')->where('id', $this->deletingId)->delete();
        $this->showDeleteModal = false;
        $this->deletingId      = null;
        $this->loadRecords();
        $this->dispatch('spu-toast', message: 'Registro eliminado correctamente.', type: 'success');
    }

    public function closeModal(): void
    {
        $this->showModal       = false;
        $this->showEditModal   = false;
        $this->showDeleteModal = false;
    }

    public function toggleStatus(int $id, string $currentStatus): void
    {
        $newStatus = $currentStatus === 'active' ? 'canceled' : 'active';
        DB::table('user_services')->where('id', $id)->update([
            'status'     => $newStatus,
            'updated_at' => now(),
        ]);
        $this->loadRecords();
    }
}
