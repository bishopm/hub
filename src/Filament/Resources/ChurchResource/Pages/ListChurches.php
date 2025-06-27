<?php

namespace Bishopm\Hub\Filament\Resources\ChurchResource\Pages;

use Bishopm\Hub\Filament\Resources\ChurchResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListChurches extends ListRecords
{
    protected static string $resource = ChurchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
