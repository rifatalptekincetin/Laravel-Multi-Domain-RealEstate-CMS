<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ListingCategoryResource\Pages;
use App\Filament\Resources\ListingCategoryResource\RelationManagers;
use App\Models\ListingCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Awcodes\Curator\Components\Forms\CuratorPicker;

use CodeWithDennis\FilamentSelectTree\SelectTree;
class ListingCategoryResource extends Resource
{
    protected static ?string $model = ListingCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-hashtag';

    protected static ?string $navigationLabel = 'İlan Kategorileri';
    protected static ?string $modelLabel = 'İlan Kategorisi';
    protected static ?string $pluralModelLabel = 'İlan Kategorileri';
    protected static ?string $navigationGroup = 'İlanlar';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Başlık')
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->maxLength(255),
                CuratorPicker::make('image_id')
                    ->relationship('image', 'id')
                    ->label("Öne Çıkan Resim"),
                Forms\Components\Select::make('status')
                    ->label('Durum')
                    ->options([
                        'draft' => 'Taslak',
                        'published' => 'Yayında',
                    ])    
                    ->required()
                    ->default('draft'),
                Forms\Components\Textarea::make('content')
                    ->label('İçerik')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('meta_title')
                    ->label('Meta Başlığı')
                    ->maxLength(255),
                Forms\Components\TextInput::make('meta_description')
                    ->label('Meta Açıklaması')
                    ->maxLength(255),
                SelectTree::make('parent_id')
                    ->label('Üst Kategori')
                    ->relationship('parent', 'title', 'parent_id')
                    ->parentNullValue(0)
                    ->enableBranchNode(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Başlık')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Durum')
                    ->searchable(),
                Tables\Columns\TextColumn::make('meta_title')
                    ->label('Meta Başlığı')
                    ->searchable(),
                Tables\Columns\TextColumn::make('meta_description')
                    ->label('Meta Açıklaması')
                    ->searchable(),
                Tables\Columns\TextColumn::make('parent.title')
                    ->label('Üst Kategori')
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
            ]);
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
            'index' => Pages\ListListingCategories::route('/'),
            'create' => Pages\CreateListingCategory::route('/create'),
            'edit' => Pages\EditListingCategory::route('/{record}/edit'),
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
