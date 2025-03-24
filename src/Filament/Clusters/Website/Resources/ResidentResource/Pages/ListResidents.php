<?php

namespace Bishopm\Hub\Filament\Clusters\Website\Resources\ResidentResource\Pages;

use Bishopm\Hub\Filament\Clusters\Website\Resources\ResidentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListResidents extends ListRecords
{
    protected static string $resource = ResidentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
