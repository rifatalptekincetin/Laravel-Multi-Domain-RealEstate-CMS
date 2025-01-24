<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\UserResource\Pages;
use App\Filament\App\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Awcodes\Curator\Components\Forms\CuratorPicker;

use FilamentTiptapEditor\TiptapEditor;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Kullanıcılar';
    protected static ?string $modelLabel = 'Kullanıcı';
    protected static ?string $pluralModelLabel = 'Kullanıcılar';
    protected static ?int $navigationSort = 93;
    //protected static ?string $navigationGroup = 'Blog';

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
                Forms\Components\DateTimePicker::make('email_verified_at')
                ->label('E-posta Doğrulama Tarihi'),
                Forms\Components\TextInput::make('password')
                    ->label('Şifre')
                    ->password()
                    ->maxLength(255),
                Forms\Components\Section::make('Profil')
                ->description('Profil sayfası için gerekli alanlar')
                ->schema([
                    CuratorPicker::make('image_id')
                                ->label("Fotoğraf")
                                ->columnSpan(2),
                    CuratorPicker::make('banner_id')
                                ->label("Kapak Fotoğrafı")
                                ->columnSpan(2),
                    TiptapEditor::make('about')
                                ->label("Hakkında")
                                ->columnSpanFull(),
                    Forms\Components\Select::make('site_id')
                                ->label('Site')
                                ->relationship('site', 'title'),
                    Forms\Components\TextInput::make('title')
                                ->label("Unvan"),
                    Forms\Components\TextInput::make('phone')
                                ->label("Telefon"),
                    Forms\Components\TextInput::make('whatsapp')
                                ->label("Whatsapp")
                                ->helperText("Format: 905367375921"),
                    Forms\Components\TextInput::make('telegram')
                                ->label("Telegram")
                                ->helperText("Format: link"),
                    Forms\Components\TextInput::make('facebook')
                                ->label("Facebook")
                                ->helperText("Format: link"),
                    Forms\Components\TextInput::make('instagram')
                                ->label("Instagram")
                                ->helperText("Format: link"),
                    Forms\Components\TextInput::make('twitter')
                                ->label("Twitter")
                                ->helperText("Format: link"),
                    Forms\Components\TextInput::make('tiktok')
                                ->label("TikTok")
                                ->helperText("Format: link"),
                    Forms\Components\TextInput::make('linkedin')
                                ->label("LinkedIn")
                                ->helperText("Format: link"),
                    Forms\Components\TextInput::make('youtube')
                                ->label("Youtube")
                                ->helperText("Format: link"),
                    Forms\Components\TextInput::make('pinterest')
                                ->label("Pinterest")
                                ->helperText("Format: link"),
                ])->columns(4)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('İsim')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('E-posta')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->label('E-posta Doğrulama T.')
                    ->dateTime()
                    ->sortable(),
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
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereIn('site_id', auth()->user()->sites->pluck('id')->toArray());
    }

    public static function canAccess(): bool
    {
        return auth()->user()->sites()->count() > 0;
    }
}
