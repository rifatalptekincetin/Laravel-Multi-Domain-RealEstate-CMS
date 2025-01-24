<?php

namespace App\Filament\Resources\ListingOptionResource\Pages;

use App\Filament\Resources\ListingOptionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListListingOptions extends ListRecords
{
    protected static string $resource = ListingOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
