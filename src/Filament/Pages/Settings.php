<?php

namespace Bishopm\Hub\Filament\Pages;
 
use Closure;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Bishopm\Hub\Filament\Clusters\Settings as SettingsCluster;
use Dotswan\MapPicker\Fields\Map;
use Filament\Forms\Components\Textarea;
use Outerweb\FilamentSettings\Filament\Pages\Settings as BaseSettings;

class Settings extends BaseSettings
{
    protected static ?string $cluster = SettingsCluster::class;

    public static array|string $routeMiddleware = ['adminonly'];

    public function schema(): array|Closure
    {
        return [
            Tabs::make('Settings')
                ->schema([
                    Tabs\Tab::make('General')
                        ->columns(2)
                        ->schema([
                            TextInput::make('general.site_name')->required(),
                            TextInput::make('general.phone'),
                            TextInput::make('general.email'),
                            TextInput::make('general.mapbox_token'),
                            Textarea::make('general.physical_address'),
                            Map::make('general.map_location')->label('Location')
                        ]),
                ]),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return 'Site settings';
    }
}