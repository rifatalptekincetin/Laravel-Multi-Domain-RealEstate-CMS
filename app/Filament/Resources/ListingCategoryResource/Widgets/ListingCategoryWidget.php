<?php

namespace App\Filament\Resources\ListingCategoryResource\Widgets;

use App\Models\ListingCategory;
use App\Filament\Resources\ListingCategoryResource;
use Filament\Notifications\Notification;
use SolutionForest\FilamentTree\Actions\Action;
use SolutionForest\FilamentTree\Actions\ActionGroup;
use SolutionForest\FilamentTree\Actions\DeleteAction;
use SolutionForest\FilamentTree\Actions\EditAction;
use SolutionForest\FilamentTree\Actions\ViewAction;
use SolutionForest\FilamentTree\Widgets\Tree as BaseWidget;

class ListingCategoryWidget extends BaseWidget
{
    protected static string $model = ListingCategory::class;

    protected static int $maxDepth = 2;

    protected ?string $treeTitle = 'Kategori Ağacı';

    protected bool $enableTreeTitle = true;

    protected function getFormSchema(): array
    {
        return [
            //
        ];
    }

    // INFOLIST, CAN DELETE
    public function getViewFormSchema(): array {
        return [
            //
        ];
    }

    // CUSTOMIZE ICON OF EACH RECORD, CAN DELETE
    // public function getTreeRecordIcon(?\Illuminate\Database\Eloquent\Model $record = null): ?string
    // {
    //     return null;
    // }

    // CUSTOMIZE ACTION OF EACH RECORD, CAN DELETE 
    protected function getTreeActions(): array
    {
         return [
            Action::make('Edit')->url(function (ListingCategory $record){
                return ListingCategoryResource::getUrl('edit', ['record' => $record]);
            }),
    //         // ViewAction::make(),
    //         // EditAction::make(),
    //         ActionGroup::make([
    //             
    //             ViewAction::make(),
    //             EditAction::make(),
    //         ]),
    //         DeleteAction::make(),
         ];
     }
    // OR OVERRIDE FOLLOWING METHODS
    //protected function hasDeleteAction(): bool
    //{
    //    return true;
    //}
    //protected function hasEditAction(): bool
    //{
    //    return true;
    //}
    //protected function hasViewAction(): bool
    //{
    //    return true;
    //}
}