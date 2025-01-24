<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ListingResource\Pages;
use App\Filament\Resources\ListingResource\RelationManagers;
use App\Models\Listing;
use App\Models\ListingOption;
use App\Models\ListingMeta;
use App\Models\ListingCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Cheesegrits\FilamentGoogleMaps\Fields\Map;

use Awcodes\Curator\Components\Forms\CuratorPicker;

use App\Filament\Resources\Set;

use App\Models\State;
use App\Models\City;
use App\Models\District;

use CodeWithDennis\FilamentSelectTree\SelectTree;

use FilamentTiptapEditor\TiptapEditor;

class ListingResource extends Resource
{
    protected static ?string $model = Listing::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    protected static ?string $navigationLabel = 'İlanlar';
    protected static ?string $modelLabel = 'İlan';
    protected static ?string $pluralModelLabel = 'İlanlar';
    protected static ?string $navigationGroup = 'İlanlar';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        if(static::getEloquentQuery()->whereIn('status',['draft'])->count()){
            return static::getEloquentQuery()->whereIn('status',['draft'])->count();
        }
        return Null;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make('Kategori')
                    ->schema([
                        SelectTree::make('categories')
                        ->label('Kategoriler')
                        ->relationship('categories', 'title', 'parent_id')
                        ->parentNullValue(0)
                        ->enableBranchNode()
                        ->live()
                        ->columnSpanFull()
                        ->afterStateUpdated(function (SelectTree $component,Forms\Get $get,Forms\Set $set)
                            {
                                $ids = $get('categories');
                                if($ids){
                                    $ids = array_merge($ids, ListingCategory::whereIn('id',$ids)->pluck('parent_id')->toArray());
                                    $ids = array_unique($ids);
                                    $ids = array_filter($ids);
                                    $ids = array_merge($ids, ListingCategory::whereIn('id',$ids)->pluck('parent_id')->toArray());
                                    $ids = array_unique($ids);
                                    $ids = array_filter($ids);
                                    $set('categories', $ids);
                                    if(ListingCategory::whereIn('id',$ids)->where('title','like','%iralık%')->count()){
                                        $set('price_type','monthly');
                                    }
                                    $component
                                    ->getContainer()
                                    ->getComponent('categoryFields')
                                    ->getChildComponentContainer()
                                    ->fill();
                                }
                            }
                        ),

                        Forms\Components\Grid::make(2)
                        ->schema(function (Listing|null $record,Forms\Get $get): array{
                            $categories = $get('categories');
                            if(!$categories) return [];
                            $listing_options = ListingOption::where('status','published')
                            ->whereHas('categories',function($query) use ($categories){
                                $query->whereIn('listing_categories.id',$categories);
                            })->orderBy("order")->get();
                            $ret = [];
                            foreach($listing_options as $option){
                                $meta = new ListingMeta;
                                if($record){
                                    $meta = ListingMeta::where('listing_id',$record->id)->where('listing_option_id',$option->id)->first();
                                }
                                if(!$meta){
                                    $meta = new ListingMeta;
                                }
                                switch ($option->type) {
                                    case 'select':
                                        $ret[] = Forms\Components\Select::make('option__'.$option->id)
                                        ->options($option->answers)
                                        ->label($option->title)
                                        ->helperText($option->helper)
                                        ->afterStateHydrated(
                                            function (Forms\Components\Select $component) use ($meta) {
                                                if($meta->meta_value){
                                                    $component->state($meta->meta_value[0]);
                                                }
                                        });
                                        break;
                                    case 'multiselect':
                                        $ret[] = Forms\Components\Select::make('option__'.$option->id)
                                        ->options($option->answers)
                                        ->multiple()
                                        ->label($option->title)
                                        ->helperText($option->helper)
                                        ->afterStateHydrated(
                                            function (Forms\Components\Select $component) use ($meta) {
                                                if($meta->meta_value){
                                                    $component->state($meta->meta_value);
                                                }
                                        });
                                        break;
                                    case 'radio':
                                        $ret[] = Forms\Components\Radio::make('option__'.$option->id)
                                        ->options($option->answers)
                                        ->label($option->title)
                                        ->helperText($option->helper)
                                        ->columns(2)
                                        ->afterStateHydrated(
                                            function (Forms\Components\Radio $component) use ($meta) {
                                                if($meta->meta_value){
                                                    $component->state($meta->meta_value[0]);
                                                }
                                        });
                                        break;
                                    case 'checkbox':
                                        $ret[] = Forms\Components\CheckboxList::make('option__'.$option->id)
                                        ->options($option->answers)
                                        ->label($option->title)
                                        ->helperText($option->helper)
                                        ->columns(2)
                                        ->afterStateHydrated(
                                            function (Forms\Components\CheckboxList $component) use ($meta) {
                                                if($meta->meta_value){
                                                    $component->state($meta->meta_value);
                                                }
                                        });
                                        break;
                                    case 'text':
                                        $ret[] = Forms\Components\TextInput::make('option__'.$option->id)
                                        ->label($option->title)
                                        ->helperText($option->helper)
                                        ->afterStateHydrated(
                                            function (Forms\Components\TextInput $component) use ($meta) {
                                                if($meta->meta_value){
                                                    $component->state($meta->meta_value[0]);
                                                }
                                        });
                                        break;
                                    case 'number':
                                        $ret[] = Forms\Components\TextInput::make('option__'.$option->id)
                                        ->numeric()
                                        ->label($option->title)
                                        ->helperText($option->helper)
                                        ->afterStateHydrated(
                                            function (Forms\Components\TextInput $component) use ($meta) {
                                                if($meta->meta_value){
                                                    $component->state($meta->meta_value[0]);
                                                }
                                        });
                                        break;
                                    case 'textarea':
                                        $ret[] = Forms\Components\Textarea::make('option__'.$option->id)
                                        ->label($option->title)
                                        ->helperText($option->helper)
                                        ->afterStateHydrated(
                                            function (Forms\Components\Textarea $component) use ($meta) {
                                                if($meta->meta_value){
                                                    $component->state($meta->meta_value[0]);
                                                }
                                        });;
                                        break;
                                }
                            }
                            return $ret;
                        })
                        ->key('categoryFields'),
                        
                    ]),
                    Forms\Components\Wizard\Step::make('İçerik')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Başlık')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('slug')
                            ->maxLength(255),
                        Forms\Components\Select::make('status')
                            ->label('Durum')
                            ->options([
                                'draft' => 'Taslak',
                                'published' => 'Yayında',
                            ])    
                            ->required()
                            ->default('draft'),
                        Forms\Components\Select::make('site_id')
                            ->label('Site')
                            ->relationship('site', 'title'),
                        Forms\Components\Select::make('user_id')
                            ->label('Kullanıcı')
                            ->relationship('user', 'name'),
                        
                        Forms\Components\TextInput::make('video_url')
                            ->label("Youtube Iframe Url")
                            ->columnSpan(3),

                        Forms\Components\TextInput::make('price')
                            ->label("Fiyat (₺)")
                            ->numeric()
                            ->columnSpan(1),

                        Forms\Components\Select::make('price_type')
                            ->label('Fiyat Tipi')
                            ->options([
                                'full' => 'Tek Fiyat',
                                'monthly' => 'Aylık',
                                'yearly' => 'Yıllık',
                            ])
                            ->default('full')
                            ->columnSpan(1),

                        TiptapEditor::make('content')
                            ->label('İçerik')
                            ->columnSpanFull(),
                        
                    ])->columns(5),
                    Forms\Components\Wizard\Step::make('Resim')
                    ->schema([
                        CuratorPicker::make('image_id')
                            ->relationship('image', 'id')
                            ->label("Öne Çıkan Resim")
                            ->listDisplay(False),
                        CuratorPicker::make('listing_media_ids')
                            ->multiple()
                            ->relationship('images', 'id')
                            ->orderColumn('order')
                            ->label("Galeri"),
                    ])->columns(2),
                    Forms\Components\Wizard\Step::make('Konum')
                    ->schema([
                        Forms\Components\Select::make('state_id')
                            ->label('İl')
                            ->relationship('state', 'title')
                            ->preload()
                            ->searchable()
                            ->reactive()
                            ->afterStateUpdated(function ($set, $state) {
                                $set('city_id', NULL);
                            })
                            ->required(),
                        Forms\Components\Select::make('city_id')
                            ->label('İlçe')
                            ->relationship('city', 'title')
                            ->preload()
                            ->searchable()
                            ->reactive()
                            ->options(function(callable $get){
                                $state = State::find($get('state_id'));
                                if($state){
                                    return City::where('state_id',$state->id)->pluck('title', 'id');
                                } else{
                                    return City::limit(50)->pluck('title', 'id');
                                }
                            })
                            ->afterStateUpdated(function ($set, $state) {
                                $set('district_id', NULL);
                            })
                            ->required(),
                        Forms\Components\Select::make('district_id')
                            ->label('Mahalle')
                            ->relationship('district', 'title')
                            ->preload()
                            ->searchable()
                            ->reactive()
                            ->options(function(callable $get){
                                $city = City::find($get('city_id'));
                                if($city){
                                    return District::where('city_id',$city->id)->pluck('title', 'id');
                                } else{
                                    return District::limit(50)->pluck('title','id');
                                }
                            })
                            ->required(),
                        Forms\Components\TextInput::make('latitude')
                            ->required()
                            ->numeric()
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('longitude')
                            ->required()
                            ->numeric()
                            ->columnSpan(1),

                        Map::make('location')
                        ->label('Haritadan konumu işaretleyin')
                        ->geolocate()
                        ->geolocateLabel('Konumum')
                        ->geolocateOnLoad(true, false)
                        ->mapControls([
                            'mapTypeControl'    => true,
                            'scaleControl'      => true,
                            'streetViewControl' => true,
                            'rotateControl'     => true,
                            'fullscreenControl' => true,
                            'searchBoxControl'  => false,
                            'zoomControl'       => true,
                        ])
                        ->clickable(true)
                        ->defaultZoom(5)
                        ->live()
                        ->reactive()
                        ->afterStateUpdated(function ($state, callable $get, callable $set) {
                            $set('latitude', $state['lat']);
                            $set('longitude', $state['lng']);
                        })
                        ->afterStateHydrated(function ($state, callable $get, callable $set) {
                            $set('latitude', $state['lat']);
                            $set('longitude', $state['lng']);
                        })
                        ->columnSpan('full'),
                    ])->columns(5),
                    Forms\Components\Wizard\Step::make('Seo')
                    ->schema([
                        Forms\Components\TextInput::make('meta_title')
                            ->label('Meta Başlığı')
                            ->maxLength(255)
                            ->columnSpan('full'),
                        Forms\Components\Textarea::make('meta_description')
                            ->label('Meta Açıklaması')
                            ->maxLength(255)
                            ->columnSpan('full'),
                    ]),
                ])->columnSpan('full'),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Başlık')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Durum')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'warning',
                        'published' => 'success',
                    })
                    ->formatStateUsing(fn (string $state): string => [
                        'draft' => 'Taslak',
                        'published' => 'Yayında',
                    ][$state])
                    ->searchable(),
                Tables\Columns\TextColumn::make('latitude')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('longitude')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('state.title')
                    ->label('İl')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('city.title')
                    ->label('İlçe')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('district.title')
                    ->label('Mahalle')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('site.title')
                    ->label('Site')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->label('Silinme T.')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Oluşturulma T.')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Güncellenme T.')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])->defaultSort('id', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListListings::route('/'),
            'create' => Pages\CreateListing::route('/create'),
            'edit' => Pages\EditListing::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

}
