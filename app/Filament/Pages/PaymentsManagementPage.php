<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreTypePaymentRequest;
use App\Http\Requests\UpdateTypePaymentRequest;

class PaymentsManagementPage extends Page
{
    protected string $view = 'filament.pages.payments-management';

    public function getTitle(): string { return 'Tipos de Pago'; }
    public static function getNavigationLabel(): string { return 'Tipos de Pago'; }
    public static function getNavigationIcon(): string { return 'heroicon-o-credit-card'; }
    public static function shouldRegisterNavigation(): bool { return false; }

    public $payments = [];

    // Modal state
    public bool $showModal = false;
    public bool $showDeleteModal = false;
    public ?int $editingId = null;
    public ?int $deletingId = null;

    // Form fields — type_payment
    public string $name = '';
    public string $status = '1';

    // Form fields — type_payment_details
    public string $agreement = '';
    public string $reference = '';
    public string $bank = '';
    public string $account_type = '';
    public string $account_number = '';
    public string $holder = '';
    public string $nit = '';
    public string $cellphone = '';
    public string $value = '';

    // Validation errors
    public array $errors = [];

    public function mount(): void
    {
        $this->loadPayments();
    }

    public function loadPayments(): void
    {
        $this->payments = DB::table('type_payment as tp')
            ->leftJoin('type_payment_details as tpd', 'tpd.id_payment_detail', '=', 'tp.id')
            ->select(
                'tp.id', 'tp.name', 'tp.status',
                'tpd.id as detail_id',
                'tpd.agreement', 'tpd.reference', 'tpd.bank',
                'tpd.account_type', 'tpd.account_number',
                'tpd.holder', 'tpd.nit', 'tpd.cellphone', 'tpd.value'
            )
            ->orderBy('tp.id')
            ->get()
            ->toArray();
    }

    public function openCreate(): void
    {
        $this->resetForm();
        $this->editingId = null;
        $this->showModal = true;
    }

    public function openEdit(int $id): void
    {
        $row = collect($this->payments)->firstWhere('id', $id);
        if (!$row) return;

        $this->editingId = $id;
        $this->name         = $row->name ?? '';
        $this->status       = (string)($row->status ?? '1');
        $this->agreement    = $row->agreement ?? '';
        $this->reference    = $row->reference ?? '';
        $this->bank         = $row->bank ?? '';
        $this->account_type = $row->account_type ?? '';
        $this->account_number = $row->account_number ?? '';
        $this->holder       = $row->holder ?? '';
        $this->nit          = $row->nit ?? '';
        $this->cellphone    = $row->cellphone ?? '';
        $this->value        = $row->value ?? '';
        $this->errors       = [];
        $this->showModal    = true;
    }

    public function save(): void
    {
        $this->errors = [];

        if (trim($this->name) === '') {
            $this->errors['name'] = 'El nombre es obligatorio.';
        }
        if (trim($this->holder) === '') {
            $this->errors['holder'] = 'El titular es obligatorio.';
        }
        if ($this->value !== '' && !is_numeric($this->value)) {
            $this->errors['value'] = 'El valor debe ser numérico.';
        }

        if (!empty($this->errors)) return;

        $now = now();

        if ($this->editingId) {
            DB::table('type_payment')->where('id', $this->editingId)->update([
                'name' => $this->name,
                'status' => $this->status,
                'updated_at' => $now,
            ]);

            $detail = DB::table('type_payment_details')->where('id_payment_detail', $this->editingId)->first();
            $detailData = [
                'agreement'      => $this->agreement,
                'reference'      => $this->reference,
                'bank'           => $this->bank,
                'account_type'   => $this->account_type,
                'account_number' => $this->account_number,
                'holder'         => $this->holder,
                'nit'            => $this->nit,
                'cellphone'      => $this->cellphone,
                'value'          => $this->value ?: null,
                'updated_at'     => $now,
            ];
            if ($detail) {
                DB::table('type_payment_details')->where('id_payment_detail', $this->editingId)->update($detailData);
            } else {
                DB::table('type_payment_details')->insert(array_merge($detailData, [
                    'id_payment_detail' => $this->editingId,
                    'status' => '1',
                    'created_at' => $now,
                ]));
            }
        } else {
            $paymentId = DB::table('type_payment')->insertGetId([
                'name' => $this->name,
                'status' => $this->status,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            DB::table('type_payment_details')->insert([
                'id_payment_detail' => $paymentId,
                'agreement'      => $this->agreement,
                'reference'      => $this->reference,
                'bank'           => $this->bank,
                'account_type'   => $this->account_type,
                'account_number' => $this->account_number,
                'holder'         => $this->holder,
                'nit'            => $this->nit,
                'cellphone'      => $this->cellphone,
                'value'          => $this->value ?: null,
                'status'         => '1',
                'created_at'     => $now,
                'updated_at'     => $now,
            ]);
        }

        $this->showModal = false;
        $this->loadPayments();
    }

    public function confirmDelete(int $id): void
    {
        $this->deletingId = $id;
        $this->showDeleteModal = true;
    }

    public function delete(): void
    {
        if (!$this->deletingId) return;

        DB::table('type_payment_details')->where('id_payment_detail', $this->deletingId)->delete();
        DB::table('type_payment')->where('id', $this->deletingId)->delete();

        $this->showDeleteModal = false;
        $this->deletingId = null;
        $this->loadPayments();
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->showDeleteModal = false;
        $this->errors = [];
    }

    private function resetForm(): void
    {
        $this->name = $this->status = '';
        $this->status = '1';
        $this->agreement = $this->reference = $this->bank = '';
        $this->account_type = $this->account_number = $this->holder = '';
        $this->nit = $this->cellphone = $this->value = '';
        $this->errors = [];
    }
}
