<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class LeadsPage extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;

    protected string $view = 'filament.pages.coming-soon';

    protected static ?string $navigationLabel = 'Leads';

    protected static ?string $title = 'Leads';

    protected static string|UnitEnum|null $navigationGroup = 'Otros';

    protected static ?int $navigationSort = 1;
}
