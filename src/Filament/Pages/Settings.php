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
                    Tabs\Tab::make('Database')
                        ->columns(2)
                        ->schema([
                            TextInput::make('database.database'),
                            TextInput::make('database.username'),
                            TextInput::make('database.password')->password(),
                        ]),
                    Tabs\Tab::make('Email')
                        ->columns(2)
                        ->schema([
                            TextInput::make('email.hub_email'),
                            TextInput::make('email.mailer'),
                            TextInput::make('email.mail_host'),
                            TextInput::make('email.mail_port'),
                            TextInput::make('email.mail_username'),
                            TextInput::make('email.mail_password')->password(),
                            TextInput::make('email.mail_encryption'),
                            TextInput::make('email.mail_from_address'),
                            TextInput::make('email.mail_from_name')
                        ]),
                    Tabs\Tab::make('General')
                        ->columns(2)
                        ->schema([
                            TextInput::make('general.site_name')->required(),
                            TextInput::make('general.phone'),
                            TextInput::make('general.email'),
                            TextInput::make('general.linkedin'),
                            Textarea::make('general.physical_address'),
                            Map::make('general.map_location')->label('Location'),
                            TextInput::make('general.church_storage_url'),
                        ]),
                    Tabs\Tab::make('Services')
                        ->columns(2)
                        ->schema([
                            TextInput::make('services.mapbox_token'),
                        ]),
                ]),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return 'Site settings';
    }
}