<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\FormSubmissionResource\Pages;
use App\Filament\App\Resources\FormSubmissionResource\RelationManagers;
use App\Models\FormSubmission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FormSubmissionResource extends Resource
{
    protected static ?string $model = FormSubmission::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    protected static ?string $navigationLabel = 'Form Gönderileri';
    protected static ?string $modelLabel = 'Form Gönderisi';
    protected static ?string $pluralModelLabel = 'Form Gönderileri';

    protected static ?int $navigationSort = 13;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('url')
                    ->maxLength(255)
                    ->default(null)
                    ->columnSpanFull(),
                Forms\Components\Select::make('form_type')
                    ->label("Form Tipi")
                    ->options([
                        'custom-form'=>'Form',
                        'contact'=>'İletişim',
                        'comment'=>'Yorum',
                    ])
                    ->default(null),
                Forms\Components\Select::make('site_id')
                    ->label('Site')
                    ->relationship('site', 'title'),
                Forms\Components\KeyValue::make('fields')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('form_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('site_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
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
            'index' => Pages\ListFormSubmissions::route('/'),
            'create' => Pages\CreateFormSubmission::route('/create'),
            'edit' => Pages\EditFormSubmission::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereIn('site_id', auth()->user()->sites()->pluck('id')->toArray());
    }

    public static function canAccess(): bool
    {
        return auth()->user()->sites()->count() > 0;
    }
}
