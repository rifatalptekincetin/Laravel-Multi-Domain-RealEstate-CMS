<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReviewResource\Pages;
use App\Filament\Resources\ReviewResource\RelationManagers;
use App\Models\Review;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?string $navigationLabel = 'Yorumlar';
    protected static ?string $modelLabel = 'Yorum';
    protected static ?string $pluralModelLabel = 'Yorumlar';
    protected static ?int $navigationSort = 13;

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
                Forms\Components\TextInput::make('name')
                    ->label('İsim')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label('E-posta')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('content')
                    ->label('Yorum')
                    ->columnSpanFull(),
                Forms\Components\Select::make('rating')
                    ->label('Puan')
                    ->required()
                    ->default(5)
                    ->options([
                        1=>1,
                        2=>2,
                        3=>3,
                        4=>4,
                        5=>5,
                    ]),
                Forms\Components\Select::make('status')
                    ->label('Durum')
                    ->required()
                    ->options([
                        'draft' => 'Taslak',
                        'published' => 'Yayınlanmış',
                    ])
                    ->default('draft'),
                Forms\Components\Select::make('reviewable_type')
                    ->label('Model')
                    ->required()
                    ->options([
                        'App\Models\User' => 'Danışman',
                    ])
                    ->default('App\Models\User')
                    ->reactive()
                    ->afterStateUpdated(function ($set, $state) {
                        $set('reviewable_id', NULL);
                    }),
                Forms\Components\Select::make('reviewable_id')
                    ->label('Kayıt')
                    ->searchable()
                    ->required()
                    ->options(function(callable $get){
                        return $get('reviewable_type')::limit(50)->pluck('name', 'id');
                    })
                    ->getSearchResultsUsing(function (string $search,callable $get): array {
                        return $get('reviewable_type')::where('name','like',"%".$search."%")->limit(50)->pluck('name', 'id')->toArray();
                    }),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('rating')
                    ->label('Puan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('İsim')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('E-posta')
                    ->searchable(),
                Tables\Columns\TextColumn::make('reviewable_id')
                    ->label('Model')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('reviewable_type')
                    ->label('Kayıt')
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
            'index' => Pages\ListReviews::route('/'),
            'create' => Pages\CreateReview::route('/create'),
            'edit' => Pages\EditReview::route('/{record}/edit'),
        ];
    }
}
