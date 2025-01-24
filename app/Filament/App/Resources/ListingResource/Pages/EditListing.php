<?php

namespace App\Filament\App\Resources\ListingResource\Pages;

use Illuminate\Database\Eloquent\Model;

use App\Models\Listing;
use App\Models\ListingOption;
use App\Models\ListingMeta;

use App\Filament\App\Resources\ListingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

use Illuminate\Support\Str;

class EditListing extends EditRecord
{
    protected static string $resource = ListingResource::class;

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

        if(!$data["user_id"]){
            $data["user_id"] = auth()->user()->id;
        }
        $data["site_id"] = auth()->user()->site_id;
        $record->update($data);

        ListingMeta::where('listing_id',$record->id)->delete();
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
