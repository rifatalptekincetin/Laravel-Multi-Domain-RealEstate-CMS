<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CreatePage extends CreateRecord
{
    protected static string $resource = PageResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        if(!$data['slug']){
            #str slugify title
            $data['slug'] = Str::slug($data['title']);
        }
        while(static::getModel()::where('slug',$data['slug'])->count()){
            $data['slug'] = $data['slug'].'-'.rand(1,1000);
        }
        
        $record = static::getModel()::create($data);

        return $record;
    }
}
