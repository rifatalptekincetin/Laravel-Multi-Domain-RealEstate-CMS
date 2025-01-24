<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ListingOptionResource\Pages;
use App\Filament\Resources\ListingOptionResource\RelationManagers;
use App\Models\ListingOption;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use CodeWithDennis\FilamentSelectTree\SelectTree;

class ListingOptionResource extends Resource
{
    protected static ?string $model = ListingOption::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-3-bottom-left';

    protected static ?string $navigationLabel = 'İlan Alanları';
    protected static ?string $modelLabel = 'İlan Alanı';
    protected static ?string $pluralModelLabel = 'İlan Alanları';
    protected static ?string $navigationGroup = 'İlanlar';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Başlık')
                    ->maxLength(255),
                Forms\Components\Select::make('status')
                    ->label('Durum')
                    ->options([
                        'draft' => 'Taslak',
                        'published' => 'Yayında',
                    ])    
                    ->required()
                    ->default('draft'),
                Forms\Components\Textarea::make('helper')
                    ->label('Yardımcı Metin')
                    ->maxLength(255),
                Forms\Components\Select::make('type')
                    ->label('Tip')
                    ->options([
                        'select' => 'Select',
                        'multiselect' => 'Multi-Select',
                        'radio' => 'Radio',
                        'checkbox' => 'Checkbox',
                        'text' => 'Text',
                        'number' => 'Number',
                        'textarea' => 'Textarea',
                    ])
                    ->default('select'),
                Forms\Components\KeyValue::make('answers')
                    ->label('Cevaplar')
                    ->columnSpan('full'),
                SelectTree::make('categories')
                    ->label('Kategoriler')
                    ->relationship('categories', 'title', 'parent_id')
                    ->parentNullValue(0)
                    ->enableBranchNode(),
                Forms\Components\TextInput::make('order')
                    ->label('Sıra')
                    ->required()
                    ->numeric()
                    ->default(100),
                Forms\Components\Checkbox::make('show_in_filters')
                    ->label('Filtrelemede göster')
                    ->default(0),
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
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Tip')
                    ->searchable(),
                Tables\Columns\TextColumn::make('order')
                    ->label('Sıra')
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
            'index' => Pages\ListListingOptions::route('/'),
            'create' => Pages\CreateListingOption::route('/create'),
            'edit' => Pages\EditListingOption::route('/{record}/edit'),
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
