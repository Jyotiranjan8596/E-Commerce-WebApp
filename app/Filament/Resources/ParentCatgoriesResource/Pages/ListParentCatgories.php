<?php

namespace App\Filament\Resources\ParentCatgoriesResource\Pages;

use App\Filament\Resources\ParentCatgoriesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListParentCatgories extends ListRecords
{
    protected static string $resource = ParentCatgoriesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
