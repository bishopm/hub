<?php

namespace Bishopm\Hub\Filament\Resources\ChurchResource\Pages;

use Bishopm\Hub\Filament\Resources\ChurchResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditChurch extends EditRecord
{
    protected static string $resource = ChurchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
