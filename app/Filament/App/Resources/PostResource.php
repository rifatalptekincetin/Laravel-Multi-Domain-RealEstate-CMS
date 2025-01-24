<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\PostResource\Pages;
use App\Filament\App\Resources\PostResource\RelationManagers;
use App\Models\Post;
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

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationLabel = 'Yazılar';
    protected static ?string $modelLabel = 'Yazı';
    protected static ?string $pluralModelLabel = 'Yazılar';

    protected static ?int $navigationSort = 91;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Başlık')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('slug')
                        ->maxLength(255),
                    TiptapEditor::make('content')
                        ->label('İçerik')
                        ->columnSpanFull(),
                ])->columns(2)->columnSpan(3),
                Section::make()->schema([
                    Forms\Components\Select::make('status')
                        ->label('Durum')
                        ->options([
                            'draft' => 'Taslak',
                            'published' => 'Yayında',
                        ])
                        ->required()
                        ->default('draft'),
                    Forms\Components\Select::make('categories')
                        ->label("Kategoriler")
                        ->relationship('categories', 'title')
                        ->preload()
                        ->searchable()
                        ->reactive(),
                    Forms\Components\Select::make('tags')
                        ->multiple()
                        ->label("Etiketler")
                        ->relationship('tags', 'title')
                        ->preload()
                        ->searchable()
                        ->reactive(),
                    Forms\Components\Select::make('site_id')
                        ->label('Site')
                        ->relationship('site', 'title'),
                    Forms\Components\Select::make('user_id')
                        ->required()
                        ->label('Kullanıcı')
                        ->relationship(
                            'user',
                            'name',
                            function (Builder $query){
                                if(auth()->user()->sites()->count()) return $query->where('site_id',auth()->user()->site_id);
                                return $query->where('id',auth()->user()->id);
                            },
                        ),
                    
                    CuratorPicker::make('image_id')
                        ->relationship('image', 'id')
                        ->label("Öne Çıkan Resim"),
                    Forms\Components\TextInput::make('meta_title')
                        ->label('Meta Başlığı')
                        ->maxLength(255),
                    Forms\Components\Textarea::make('meta_description')
                        ->label('Meta Açıklaması')
                        ->maxLength(255),
                    
                ])->columnSpan(1),
            ])->columns([
                'sm' => 1,
                'xl' => 4,
                '2xl' => 4,
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        if(auth()->user()->sites()->count()){
            return parent::getEloquentQuery()
                ->whereIn('site_id', auth()->user()->sites()->pluck('id'))
                ->withoutGlobalScopes([
                    SoftDeletingScope::class,
                ]);
        }
        return parent::getEloquentQuery()
            ->where('user_id', auth()->user()->id);
    }
}
