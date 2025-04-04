<?php

namespace Bishopm\Hub\Filament\Clusters\Website\Resources\EventResource\Pages;

use Bishopm\Hub\Filament\Clusters\Website\Resources\EventResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEvent extends EditRecord
{
    protected static string $resource = EventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
