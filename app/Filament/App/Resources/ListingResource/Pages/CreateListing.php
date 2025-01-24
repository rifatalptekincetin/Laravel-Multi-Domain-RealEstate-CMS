<?php

namespace App\Filament\App\Resources\ListingResource\Pages;

use Illuminate\Database\Eloquent\Model;
use App\Models\Listing;
use App\Models\ListingOption;
use App\Models\ListingMeta;

use App\Filament\App\Resources\ListingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use Illuminate\Support\Str;

class CreateListing extends CreateRecord
{
    protected static string $resource = ListingResource::class;


    protected function handleRecordCreation(array $data): Model
    {
        if(!$data["user_id"]){
            $data["user_id"] = auth()->user()->id;
        }
        if(!$data['slug']){
            #str slugify title
            $data['slug'] = Str::slug($data['title']);
        }
        while(static::getModel()::where('slug',$data['slug'])->count()){
            $data['slug'] = $data['slug'].'-'.rand(1,1000);
        }
        
        $data["site_id"] = auth()->user()->site_id;
        $record = static::getModel()::create($data);

        $options = array_intersect_key($data, array_flip(preg_grep('/^option__/', array_keys($data))));
        foreach($options as $key=>$answer){
            $id = explode('__',$key)[1];
            if(!$answer){
                continue;
            }
            $option = ListingOption::where('id',$id)->first();
            if($option->type == "number"){
                $answer = intval($answer);
            }
            if($answer){
                if(!is_array($answer)){
                    $answer = [$answer];
                }
            }
            $meta = ListingMeta::create([
                'listing_id'=>$record->id,
                'listing_option_id'=>$option->id,
                'meta_value'=>$answer,
            ]);
        }

        return $record;
    }
}
