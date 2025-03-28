<?php

namespace Bishopm\Hub\Filament\Clusters\Website\Resources\PostResource\Pages;

use Bishopm\Hub\Filament\Clusters\Website\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
