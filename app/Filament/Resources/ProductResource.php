<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms\Components\Section;
use FilamentTiptapEditor\TiptapEditor;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = 'Etkinlikler';
    protected static ?string $modelLabel = 'Etkinlik';
    protected static ?string $pluralModelLabel = 'Etkinlikler';
    protected static ?int $navigationSort = 11;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                
                Section::make()->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Başlık')
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\TextInput::make('price')
                        ->label('Fiyat')
                        ->numeric()
                        ->default(null)
                        ->prefix('₺'),
                    Forms\Components\DateTimePicker::make('event_time')
                    ->label('Etkinlik Zamanı'),
                    Forms\Components\TextInput::make('address')
                        ->label('Adres')
                        ->maxLength(255)
                        ->default(null),
                    TiptapEditor::make('content')
                        ->label('İçerik')
                        ->columnSpanFull(),

                    Forms\Components\Select::make('categories')
                        ->multiple()
                        ->label("Satın Alan Kullanıcılar")
                        ->relationship('users', 'name')
                        ->preload()
                        ->searchable()
                        ->reactive()
                        ->columnSpanFull(),

                ])->columns(2)->columnSpan(3),
                    

                Section::make()->schema([
                    CuratorPicker::make('image_id')
                        ->label("Öne Çıkan Resim"),
                    Forms\Components\Select::make('status')
                        ->label('Durum')
                        ->options([
                            'draft' => 'Taslak',
                            'published' => 'Yayında',
                        ])
                        ->required()
                        ->default('draft'),
                    Forms\Components\Select::make('type')
                        ->label('Etkinlik Tipi')
                        ->options([
                            'training' => 'Eğitim',
                            'seminar' => 'Seminer',
                            'congress' => 'Kongre',
                        ])
                        ->required()
                        ->default('seminar'),
                    Forms\Components\TextInput::make('meta_title')
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\Textarea::make('meta_description')
                        ->default(null),
                ])->columnSpan(1),


            ])->columns([
                'sm' => 1,
                'xl' => 4,
                '2xl' => 4,
            ]);;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Başlık')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Fiyat')
                    ->money('₺')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Durum')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Tip')
                    ->searchable(),
                Tables\Columns\TextColumn::make('event_time')
                    ->label('Etkinlik Zamanı')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('address')
                    ->label('Adres')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Oluşturulma')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Düzenlenme')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
