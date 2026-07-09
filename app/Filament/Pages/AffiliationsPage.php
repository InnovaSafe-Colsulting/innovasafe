<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\DB;

class AffiliationsPage extends Page
{
    protected string $view = 'filament.pages.affiliations';

    public function getTitle(): string { return 'Afiliaciones'; }
    public static function getNavigationLabel(): string { return 'Afiliaciones'; }
    public static function getNavigationIcon(): string { return 'heroicon-o-users'; }

    public $affiliations;
    public $paymentStatuses;
    public $expandedRow = null;
    public $modules = [];

    public function mount(): void
    {
        $this->paymentStatuses = DB::table('payment_status')->get();
        $this->loadAffiliations();
    }

    public function loadAffiliations(): void
    {
        $this->affiliations = DB::table('user_services as us')
            ->join('users as u', 'us.user_id', '=', 'u.id')
            ->join('plans as p', 'us.plan_id', '=', 'p.id')
            ->leftJoin('orders as o', 'us.order_id', '=', 'o.id')
            ->leftJoin('payment_status as ps', 'us.payment_status_id', '=', 'ps.id')
            ->select(
                'us.id',
                'us.user_id',
                'us.plan_id',
                'us.order_id',
                'us.payment_date',
                'us.payment_type',
                'us.billing_period',
                'us.expires_at',
                'us.status',
                'us.payment_status_id',
                'us.created_at',
                DB::raw("CONCAT(u.names, ' ', u.last_names) as user_name"),
                'u.email',
                'u.cellphone',
                'p.name as plan_name',
                'p.prize as plan_price',
                'o.order_number',
                'o.total as order_total',
                'o.payment_proof',
                'ps.name as payment_status_name',
                'ps.color as payment_status_color'
            )
            ->orderBy('us.created_at', 'desc')
            ->get();
    }

    public function toggleExpand(int $id): void
    {
        if ($this->expandedRow === $id) {
            $this->expandedRow = null;
            $this->modules = [];
        } else {
            $this->expandedRow = $id;
            $affiliation = collect($this->affiliations)->firstWhere('id', $id);
            if ($affiliation) {
                $this->modules = DB::table('type_services_detail as tsd')
                    ->join('type_services as ts', 'tsd.type_service_id', '=', 'ts.id')
                    ->where('tsd.status', 1)
                    ->select('tsd.module', 'tsd.type_module', 'ts.name as service_name')
                    ->orderBy('ts.name')
                    ->orderBy('tsd.type_module')
                    ->get()
                    ->toArray();
            }
        }
    }

    public function toggleStatus(int $id): void
    {
        $current = DB::table('user_services')->where('id', $id)->value('status');
        $new = $current == '1' ? '0' : '1';
        DB::table('user_services')->where('id', $id)->update(['status' => $new, 'updated_at' => now()]);
        $this->loadAffiliations();
    }

    public function updatePaymentStatus(int $id, int $statusId): void
    {
        DB::table('user_services')->where('id', $id)->update([
            'payment_status_id' => $statusId,
            'updated_at' => now(),
        ]);
        $this->loadAffiliations();
    }
}
