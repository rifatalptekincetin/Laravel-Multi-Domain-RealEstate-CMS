<?php

namespace App\Filament\Resources\ProductResource\Pages;

use Illuminate\Database\Eloquent\Model;
use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $data['slug'] = Str::slug($data['title']);

        while(static::getModel()::where('slug',$data['slug'])->count()){
            $data['slug'] = $data['slug'].'-'.rand(1,1000);
        }

        $record = static::getModel()::create($data);
        return $record;
    }
}
