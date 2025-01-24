<?php

namespace App\Filament\App\Resources\PageResource\Pages;

use App\Filament\App\Resources\PageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EditPage extends EditRecord
{
    protected static string $resource = PageResource::class;

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
            #str slugify title
            $data['slug'] = Str::slug($data['title']);
        }
        while(static::getModel()::where('slug',$data['slug'])->whereNot('id',$record->id)->count()){
            $data['slug'] = $data['slug'].'-'.rand(1,1000);
        }

        $data["site_id"] = auth()->user()->site_id;
        $record->update($data);
        
        return $record;
    }
}
