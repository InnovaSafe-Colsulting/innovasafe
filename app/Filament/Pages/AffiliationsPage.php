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
    public $plans;
    public $contacts;
    public $expandedRow = null;
    public $modules = [];

    // Modal nueva afiliación
    public bool $showCreateModal = false;
    public $form_contact_id = '';
    public $form_contact_name = '';
    public $form_contact_email = '';
    public $form_contact_phone = '';
    public $form_plan_id = '';
    public $form_billing_period = '';
    public $form_payment_date = '';
    public $form_expires_at = '';
    public $form_payment_status_id = '';

    public function mount(): void
    {
        $this->paymentStatuses = DB::table('payment_status')->get();
        $this->plans = DB::table('plans')->where('status', 1)->get();
        $this->contacts = DB::table('contacts')->where('converted', 0)->orderBy('names')->get();
        $this->loadAffiliations();
    }

    public function loadAffiliations(): void
    {
        $this->affiliations = DB::table('user_services as us')
            ->join('contacts as c', 'us.contact_id', '=', 'c.id')
            ->join('plans as p', 'us.plan_id', '=', 'p.id')
            ->leftJoin('orders as o', 'us.order_id', '=', 'o.id')
            ->leftJoin('payment_status as ps', 'us.payment_status_id', '=', 'ps.id')
            ->select(
                'us.id',
                'us.contact_id',
                'us.plan_id',
                'us.order_id',
                'us.payment_date',
                'us.payment_type_id',
                'us.billing_period',
                'us.expires_at',
                'us.status',
                'us.payment_status_id',
                'us.created_at',
                DB::raw("CONCAT(c.names, ' ', c.last_names) as user_name"),
                'c.email',
                'c.cellphone',
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

    public function openCreateModal(): void
    {
        $this->form_contact_id = '';
        $this->form_contact_name = '';
        $this->form_contact_email = '';
        $this->form_contact_phone = '';
        $this->form_plan_id = '';
        $this->form_billing_period = '';
        $this->form_payment_date = '';
        $this->form_expires_at = '';
        $this->form_payment_status_id = '';
        $this->showCreateModal = true;
    }

    public function closeCreateModal(): void
    {
        $this->showCreateModal = false;
    }

    public function loadContactInfo(): void
    {
        if (!$this->form_contact_id) {
            $this->form_contact_name = '';
            $this->form_contact_email = '';
            $this->form_contact_phone = '';
            return;
        }
        $contact = DB::table('contacts')->where('id', $this->form_contact_id)->first();
        if ($contact) {
            $this->form_contact_name  = $contact->names . ' ' . $contact->last_names;
            $this->form_contact_email = $contact->email;
            $this->form_contact_phone = $contact->cellphone;
        }
    }

    public function createAffiliation(): void
    {
        if (!$this->form_contact_id || !$this->form_plan_id || !$this->form_billing_period || !$this->form_payment_status_id) {
            return;
        }

        $statusId = (int) $this->form_payment_status_id;

        DB::table('user_services')->insert([
            'contact_id'        => $this->form_contact_id,
            'plan_id'           => $this->form_plan_id,
            'billing_period'    => $this->form_billing_period,
            'payment_date'      => $this->form_payment_date ?: null,
            'expires_at'        => $this->form_expires_at ?: null,
            'payment_status_id' => $statusId,
            'status'            => $statusId === 1 ? 'active' : 'canceled',
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        if ($statusId === 1) {
            $this->convertContact((int) $this->form_contact_id);
        }

        $this->contacts = DB::table('contacts')->where('converted', 0)->orderBy('names')->get();
        $this->closeCreateModal();
        $this->loadAffiliations();
    }

    private function convertContact(int $contactId): void
    {
        $contact = DB::table('contacts')->where('id', $contactId)->first();
        if (!$contact) return;

        $user = DB::table('users')->where('email', $contact->email)->first();
        if ($user) {
            DB::table('users')->where('id', $user->id)->update(['status' => '1', 'active' => 1, 'updated_at' => now()]);
        } else {
            DB::table('users')->insert([
                'names'      => $contact->names,
                'last_names' => $contact->last_names,
                'email'      => $contact->email,
                'cellphone'  => $contact->cellphone,
                'password'   => bcrypt($contact->names . $contact->cellphone),
                'city_id'    => 1,
                'role_id'    => 3,
                'status'     => '1',
                'active'     => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        DB::table('contacts')->where('id', $contactId)->update(['converted' => 1]);
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
        $new = $current === 'active' ? 'canceled' : 'active';
        DB::table('user_services')->where('id', $id)->update(['status' => $new, 'updated_at' => now()]);
        $this->loadAffiliations();
    }

    public function updatePaymentStatus(int $id, int $statusId): void
    {
        DB::table('user_services')->where('id', $id)->update([
            'payment_status_id' => $statusId,
            'status'            => $statusId === 1 ? 'active' : 'canceled',
            'updated_at'        => now(),
        ]);

        $service = DB::table('user_services')->where('id', $id)->first();
        $contact = DB::table('contacts')->where('id', $service->contact_id)->first();

        if (!$contact) {
            $this->loadAffiliations();
            return;
        }

        if ($statusId === 1) {
            $this->convertContact($contact->id);
            $this->contacts = DB::table('contacts')->where('converted', 0)->orderBy('names')->get();
        } else {
            $user = DB::table('users')->where('email', $contact->email)->first();
            if ($user) {
                DB::table('users')->where('id', $user->id)->update(['status' => '0', 'updated_at' => now()]);
            }
        }

        $this->loadAffiliations();
    }
}
