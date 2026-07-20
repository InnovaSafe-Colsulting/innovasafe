<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\DB;
use UnitEnum;

class NotificacionesPage extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBell;

    protected string $view = 'filament.pages.notificaciones';

    protected static ?string $navigationLabel = 'Notificaciones';

    protected static ?string $title = 'Notificaciones';

    protected static string|UnitEnum|null $navigationGroup = 'Gestión';

    protected static ?int $navigationSort = 7;

    public array $notifications = [];
    public bool $showModal = false;
    public string $activeModule = '';
    public ?int $expandedId = null;

    public static function getNavigationBadge(): ?string
    {
        $count = DB::table('notifications')->whereNull('read_at')->count();
        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'danger';
    }

    public function mount(): void
    {
        $this->notifications = [];
    }

    public function getCounts(): array
    {
        return DB::table('notifications')
            ->whereNull('read_at')
            ->selectRaw('module, count(*) as total')
            ->groupBy('module')
            ->pluck('total', 'module')
            ->toArray();
    }

    public function openModal(string $module): void
    {
        $this->activeModule = $module;
        $this->expandedId = null;
        $this->notifications = DB::table('notifications')
            ->where('module', $module)
            ->whereNull('read_at')
            ->orderByDesc('created_at')
            ->get()
            ->toArray();
        $this->showModal = true;
    }

    public function toggleDetail(int $id): void
    {
        $this->expandedId = $this->expandedId === $id ? null : $id;
    }

    public function markAsRead(int $id): void
    {
        DB::table('notifications')->where('id', $id)->update(['read_at' => now()]);
        $this->notifications = array_values(array_filter($this->notifications, fn($n) => $n->id !== $id));
        $this->expandedId = null;
        if (empty($this->notifications)) $this->showModal = false;
    }

    public function delete(int $id): void
    {
        DB::table('notifications')->where('id', $id)->delete();
        $this->notifications = array_values(array_filter($this->notifications, fn($n) => $n->id !== $id));
        $this->expandedId = null;
        if (empty($this->notifications)) $this->showModal = false;
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->notifications = [];
        $this->expandedId = null;
    }
}
