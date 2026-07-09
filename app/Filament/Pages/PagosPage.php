<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\DB;

class PagosPage extends Page
{
    public static function getNavigationIcon(): string { return 'heroicon-o-credit-card'; }
    protected string $view = 'filament.pages.pagos';
    protected static ?string $navigationLabel = 'Pagos';
    protected static ?string $title = 'Pagos';
    protected static ?int $navigationSort = 5;

    public static function getNavigationGroup(): ?string { return 'Gestión'; }

    public array $payments = [];
    public bool $showModal = false;
    public bool $showDeleteModal = false;
    public ?int $editingId = null;
    public ?int $deletingId = null;

    public string $name = '';
    public string $status = '1';
    public string $agreement = '';
    public string $reference = '';
    public string $bank = '';
    public string $account_type = '';
    public string $account_number = '';
    public string $holder = '';
    public string $nit = '';
    public string $cellphone = '';
    public string $value = '';
    public array $formErrors = [];

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
        $this->name = $this->agreement = $this->reference = $this->bank = '';
        $this->account_type = $this->account_number = $this->holder = '';
        $this->nit = $this->cellphone = $this->value = '';
        $this->status = '1';
        $this->editingId = null;
        $this->formErrors = [];
        $this->showModal = true;
    }

    public function openEdit(int $id): void
    {
        $row = collect($this->payments)->firstWhere('id', $id);
        if (!$row) return;
        $this->editingId      = $id;
        $this->name           = $row->name ?? '';
        $this->status         = (string)($row->status ?? '1');
        $this->agreement      = $row->agreement ?? '';
        $this->reference      = $row->reference ?? '';
        $this->bank           = $row->bank ?? '';
        $this->account_type   = $row->account_type ?? '';
        $this->account_number = $row->account_number ?? '';
        $this->holder         = $row->holder ?? '';
        $this->nit            = $row->nit ?? '';
        $this->cellphone      = $row->cellphone ?? '';
        $this->value          = $row->value ?? '';
        $this->formErrors     = [];
        $this->showModal      = true;
    }

    public function save(): void
    {
        $this->formErrors = [];
        if (trim($this->name) === '') $this->formErrors['name'] = 'El nombre es obligatorio.';
        if ($this->name !== 'PayU' && trim($this->holder) === '') $this->formErrors['holder'] = 'El titular es obligatorio.';
        if (!empty($this->formErrors)) return;

        $now = now();
        if ($this->editingId) {
            DB::table('type_payment')->where('id', $this->editingId)->update([
                'name' => $this->name, 'status' => $this->status, 'updated_at' => $now,
            ]);
            $detail = DB::table('type_payment_details')->where('id_payment_detail', $this->editingId)->first();
            $data = [
                'agreement' => $this->agreement, 'reference' => $this->reference,
                'bank' => $this->bank, 'account_type' => $this->account_type,
                'account_number' => $this->account_number, 'holder' => $this->holder,
                'nit' => $this->nit, 'cellphone' => $this->cellphone,
                'value' => $this->value ?: null, 'updated_at' => $now,
            ];
            $detail
                ? DB::table('type_payment_details')->where('id_payment_detail', $this->editingId)->update($data)
                : DB::table('type_payment_details')->insert(array_merge($data, ['id_payment_detail' => $this->editingId, 'status' => '1', 'created_at' => $now]));
        } else {
            $pid = DB::table('type_payment')->insertGetId([
                'name' => $this->name, 'status' => $this->status, 'created_at' => $now, 'updated_at' => $now,
            ]);
            DB::table('type_payment_details')->insert([
                'id_payment_detail' => $pid, 'agreement' => $this->agreement,
                'reference' => $this->reference, 'bank' => $this->bank,
                'account_type' => $this->account_type, 'account_number' => $this->account_number,
                'holder' => $this->holder, 'nit' => $this->nit, 'cellphone' => $this->cellphone,
                'value' => $this->value ?: null, 'status' => '1', 'created_at' => $now, 'updated_at' => $now,
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
        $this->formErrors = [];
    }
}
