<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CityResource\Pages;
use App\Filament\Resources\CityResource\RelationManagers;
use App\Models\City;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CityResource extends Resource
{
    protected static ?string $model = City::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    protected static ?string $navigationLabel = 'İlçeler';
    protected static ?string $modelLabel = 'İlçe';
    protected static ?string $pluralModelLabel = 'İlçeler';
    protected static ?int $navigationSort = 11;
    protected static ?string $navigationGroup = 'Lokasyon';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label("Başlık")
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->label("Slug")
                    ->maxLength(255),
                Forms\Components\Select::make('status')
                    ->label("Durum")
                    ->options([
                        'draft' => 'Taslak',
                        'published' => 'Yayında',
                    ])    
                    ->required()
                    ->default('draft'),
                Forms\Components\Select::make('state_id')
                    ->label("İl")
                    ->relationship('state', 'title'),
                Forms\Components\Textarea::make('content')
                    ->label("İçerik")
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('meta_title')
                    ->label("Meta Başlığı")
                    ->maxLength(255),
                Forms\Components\TextInput::make('meta_description')
                    ->label("Meta Açıklaması")
                    ->maxLength(255),
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
                Tables\Columns\TextColumn::make('state.title')
                    ->label('İl')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('meta_title')
                    ->label('Meta Başlığı')
                    ->searchable(),
                Tables\Columns\TextColumn::make('meta_description')
                    ->label('Meta Açıklaması')
                    ->searchable(),
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
            'index' => Pages\ListCities::route('/'),
            'create' => Pages\CreateCity::route('/create'),
            'edit' => Pages\EditCity::route('/{record}/edit'),
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
