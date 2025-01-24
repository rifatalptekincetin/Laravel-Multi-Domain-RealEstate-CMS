<?php

namespace App\Filament\App\Resources\TransactionResource\Pages;

use App\Filament\App\Resources\TransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;

class EditTransaction extends EditRecord
{
    protected static string $resource = TransactionResource::class;

    protected static ?string $title = 'Ödeme Detayları';

    protected function getHeaderActions(): array
    {
        if($this->record->status=='pending'){
            return [
                Actions\Action::make('Ödeme Bildir')
                ->icon('heroicon-m-banknotes')
                ->action(function(Model $record){
                    $record->update(['status'=>'processing']);
                    Notification::make() 
                                ->title('Ödeme yaptığınız bildirildi.')
                                ->success()
                                ->send(); 
                }),
            ];
        }
        return [];
    }

    protected function getFormActions(): array
    {
        return [];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        return $record;
    }
}
