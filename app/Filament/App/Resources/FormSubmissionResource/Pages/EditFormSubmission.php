<?php

namespace App\Filament\App\Resources\FormSubmissionResource\Pages;

use App\Filament\App\Resources\FormSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFormSubmission extends EditRecord
{
    protected static string $resource = FormSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
