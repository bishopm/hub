<?php
 
namespace Bishopm\Hub\Filament\Pages;

use Filament\Pages\Dashboard as PagesDashboard;

class Dashboard extends PagesDashboard
{
    protected static string $view = 'hub::dashboard';

    protected static ?int $navigationSort = -11;

    protected static ?string $navigationLabel = 'Hub';

    protected static ?string $title = 'Dashboard';
}