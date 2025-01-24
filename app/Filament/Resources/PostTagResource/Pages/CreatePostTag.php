<?php

namespace App\Filament\Resources\PostTagResource\Pages;

use App\Filament\Resources\PostTagResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CreatePostTag extends CreateRecord
{
    protected static string $resource = PostTagResource::class;

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
