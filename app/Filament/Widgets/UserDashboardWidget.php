<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class UserDashboardWidget extends Widget
{
    protected string $view = 'filament.widgets.user-dashboard-widget';
    
    public array $data;

    public function mount(): void
    {
        $this->data = $this->getData();
    }

    public function getData(): array
    {
        $user = Auth::user();
        
        $missingData = [];
        
        if (empty($user->names)) {
            $missingData[] = 'Nombres';
        }
        
        if (empty($user->last_names)) {
            $missingData[] = 'Apellidos';
        }
        
        if (empty($user->cellphone)) {
            $missingData[] = 'Celular';
        }
        
        if (empty($user->address)) {
            $missingData[] = 'Dirección';
        }
        
        if (empty($user->neighboarhood)) {
            $missingData[] = 'Barrio';
        }
        
        return [
            'missingData' => $missingData,
            'hasMissingData' => count($missingData) > 0,
        ];
    }
}
