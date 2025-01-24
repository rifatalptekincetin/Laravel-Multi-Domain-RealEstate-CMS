<?php

namespace App\Filament\Resources\ListingOptionResource\Pages;

use App\Filament\Resources\ListingOptionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditListingOption extends EditRecord
{
    protected static string $resource = ListingOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
