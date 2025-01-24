<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

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
