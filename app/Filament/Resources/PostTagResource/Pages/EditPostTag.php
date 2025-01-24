<?php

namespace App\Filament\Resources\PostTagResource\Pages;

use App\Filament\Resources\PostTagResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EditPostTag extends EditRecord
{
    protected static string $resource = PostTagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        if(!$data['slug']){
            $data['slug'] = Str::slug($data['title']);
        }
        while(static::getModel()::where('slug',$data['slug'])->whereNot('id',$record->id)->count()){
            $data['slug'] = $data['slug'].'-'.rand(1,1000);
        }

        $record->update($data);
        
        return $record;
    }
}
