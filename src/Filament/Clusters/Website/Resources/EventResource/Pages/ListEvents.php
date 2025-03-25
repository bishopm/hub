<?php

namespace Bishopm\Hub\Filament\Clusters\Website\Resources\EventResource\Pages;

use Bishopm\Hub\Filament\Clusters\Website\Resources\EventResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEvents extends ListRecords
{
    protected static string $resource = EventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
