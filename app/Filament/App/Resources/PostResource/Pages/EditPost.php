<?php

namespace App\Filament\App\Resources\PostResource\Pages;

use App\Filament\App\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

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
        if(!$data["user_id"]){
            $data["user_id"] = auth()->user()->id;
        }
        $data["site_id"] = auth()->user()->site_id;
        $record->update($data);
        
        return $record;
    }
}
