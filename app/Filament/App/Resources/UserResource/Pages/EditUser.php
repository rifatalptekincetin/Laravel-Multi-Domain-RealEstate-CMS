<?php

namespace App\Filament\App\Resources\UserResource\Pages;

use App\Filament\App\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
 
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        if(!$data['password']){
            unset($data['password']); 
        }
        $record->update($data);
        return $record;
    }
}
