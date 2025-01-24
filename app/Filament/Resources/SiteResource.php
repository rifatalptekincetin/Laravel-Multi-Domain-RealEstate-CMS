<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteResource\Pages;
use App\Filament\Resources\SiteResource\RelationManagers;
use App\Models\Site;
use App\Models\State;
use App\Models\City;
use App\Models\District;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Awcodes\Curator\Components\Forms\CuratorPicker;

use FilamentTiptapEditor\TiptapEditor;

class SiteResource extends Resource
{
    protected static ?string $model = Site::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Siteler';
    protected static ?string $modelLabel = 'Site';
    protected static ?string $pluralModelLabel = 'Siteler';
    protected static ?int $navigationSort = 9;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Zorunlu Alanlar')
                ->description('Subdomain, ve site sahipliği hakkındaki bilgiler')
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Başlık')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('subdomain')
                        ->label('Alt Alan Adı (sadece harf ve rakam)')
                        ->maxLength(255),

                    Forms\Components\Select::make('status')
                        ->label('Durum')
                        ->options([
                            'draft' => 'Taslak',
                            'published' => 'Yayında',
                        ])    
                        ->required()
                        ->default('draft'),

                    Forms\Components\Select::make('user_id')
                        ->label('Yetkili Kullanıcı')
                        ->relationship('user', 'name'),
                ])->columns(2),

                Forms\Components\Section::make('Kart Bilgileri')
                ->description('Ana sayfada görünecek olan ofis kartındaki bilgiler')
                ->schema([
                    Forms\Components\Select::make('state_id')
                        ->label('İl')
                        ->relationship('state', 'title')
                        ->preload()
                        ->searchable()
                        ->reactive()
                        ->afterStateUpdated(function ($set, $state) {
                            $set('city_id', NULL);
                        }),
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
                        }),
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
                        }),
                    Forms\Components\TextInput::make('address')
                        ->label('Açık Adress')
                        ->maxLength(255),
                    CuratorPicker::make('image_id')
                        ->relationship('image', 'id')
                        ->label("Profil Resmi (Kare)")
                        ->columnSpan(2),
                    Forms\Components\Textarea::make('about')
                        ->label('Hakkında (Kısa Açıklama)')
                        ->rows(4)
                        ->columnSpan(2),
                    Forms\Components\TextInput::make('email')
                        ->label('E-Posta')
                        ->type('email')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('phone')
                        ->label('Telefon')
                        ->type('tel')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('whatsapp')
                        ->label('Whatsapp')
                        ->type('tel')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('telegram')
                        ->label('Telegram')
                        ->type('url')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('facebook')
                        ->label('Facebook')
                        ->type('url')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('instagram')
                        ->label('Instagram')
                        ->type('url')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('twitter')
                        ->label('Twitter')
                        ->type('url')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('tiktok')
                        ->label('Tiktok')
                        ->type('url')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('linkedin')
                        ->label('Linkedin')
                        ->type('url')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('youtube')
                        ->label('Youtube')
                        ->type('url')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('pinterest')
                        ->label('Pinterest')
                        ->type('url')
                        ->maxLength(255),
                ])->columns(4),

                Forms\Components\Section::make('Site Ayarları')
                ->description('Sitenizde kullanıcak olan menü ve footer ayarları')
                ->schema([
                    Forms\Components\Tabs::make('Tabs')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Logo')
                        ->schema([
                            CuratorPicker::make('logo_id')
                                ->relationship('logo', 'id')
                                ->label("Logo"),
                            Forms\Components\Select::make('home_id')
                                ->label('Anasayfa')
                                ->relationship(
                                    'home',
                                    'title',
                                    function (Builder $query,Site|null $record){
                                        if($record) return $query->where('site_id',$record->id);
                                        return $query->where('id',-765948);
                                    },
                                ),
                        ])->columns(2),

                        Forms\Components\Tabs\Tab::make('Ana Menu')
                        ->statePath('menu')
                        ->default(["menu" => [
                            [
                            "title" => "Anasayfa",
                            "url" => "https://localhost/",
                            "sub_menu" => []
                            ],
                            [
                            "title" => "İlanlarımız",
                            "url" => "/ilanlar",
                            "sub_menu" => []
                            ],
                            [
                            "title" => "Danışmanlarımız",
                            "url" => "/gayrimenkul-danismanlari",
                            "sub_menu" => [],
                            ],
                            [
                            "title" => "iletisim",
                            "url" => "#",
                            "sub_menu" => [],
                            ]
                        ]])
                        ->schema([
                            Forms\Components\Repeater::make('menu')
                            ->label("Linkler")
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label("Başlık")
                                    ->required(),
                                Forms\Components\TextInput::make('url')
                                    ->label("Link")
                                    ->required(),
                                Forms\Components\Repeater::make('sub_menu')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label("Başlık")
                                            ->required(),
                                        Forms\Components\TextInput::make('url')
                                            ->label("Link")
                                            ->required(),
                                    ])->defaultItems(0),
                            ]),
                        ]),

                        Forms\Components\Tabs\Tab::make('Alt Bölüm (footer)')
                        ->statePath('footer')
                        ->default([
                            "footer_logo" => 5,
                            "footer_menu_links" => [
                                [
                                    "title" => "Anasayfa",
                                    "url" => "/",
                                ],
                            ],
                            "footer_menu2_links" => [
                                [
                                    "title" => "İlanlar",
                                    "url" => "/ilanlar",
                                ],
                            ],
                            "footer_description" => "<p>Grand Gayrimenkul</p>",
                            "footer_menu_title" => "Hızlı Erişim",
                            "footer_menu2_title" => "İlanlar",
                            "footer_contact_title" => "İletişim",
                            "footer_email" => "#",
                            "footer_phone" => "#",
                            "footer_address" => "#",
                            "footer_facebook" => "#",
                            "footer_instagram" => "#",
                            "footer_linkedin" => "#",
                            "footer_youtube" => "#",
                        ])
                        ->schema([

                            Forms\Components\Section::make('Bölüm 1')
                            ->description('Logonuz ve sizi tanıtan kısa bir açıklama')
                            ->schema([
                                CuratorPicker::make('footer_logo')
                                            ->label("Footer Logo")
                                            ->columnSpanFull(),

                                TiptapEditor::make('footer_description')
                                            ->label('Logo Altı Açıklama'),
                                
                                
                            ]),

                            Forms\Components\Section::make('Bölüm 2')
                            ->description('Sitenizde hızlı erişim için kolay menu')
                            ->schema([
                                Forms\Components\TextInput::make('footer_menu_title')
                                ->label('Menu Başlığı'),

                                Forms\Components\Repeater::make('footer_menu_links')
                                ->schema([
                                    Forms\Components\TextInput::make('title')
                                        ->label("Başlık")
                                        ->required(),
                                    Forms\Components\TextInput::make('url')
                                        ->label("Link")
                                        ->required(),
                                ]),
                                
                            ]),

                            Forms\Components\Section::make('Bölüm 3')
                            ->description('Sitenizde hızlı erişim için kolay menu')
                            ->schema([
                                Forms\Components\TextInput::make('footer_menu2_title')
                                ->label('Menu2 Başlığı'),

                                Forms\Components\Repeater::make('footer_menu2_links')
                                ->schema([
                                    Forms\Components\TextInput::make('title')
                                        ->label("Başlık")
                                        ->required(),
                                    Forms\Components\TextInput::make('url')
                                        ->label("Link")
                                        ->required(),
                                ]),
                                
                            ]),

                            Forms\Components\Section::make('Bölüm 4')
                            ->description('Alt bölüm iletişim alanaları')
                            ->schema([
                                Forms\Components\TextInput::make('footer_contact_title')
                                ->label('İletişim Başlığı'),

                                Forms\Components\TextInput::make('footer_email')
                                ->label('E-posta'),
                                
                                Forms\Components\TextInput::make('footer_phone')
                                ->label('Telefon'),

                                Forms\Components\TextInput::make('footer_address')
                                ->label('Adres'),

                                Forms\Components\TextInput::make('footer_facebook')
                                ->label('Facebook Linki'),

                                Forms\Components\TextInput::make('footer_instagram')
                                ->label('Instagram Linki'),

                                Forms\Components\TextInput::make('footer_linkedin')
                                ->label('LinkedIn Linki'),

                                Forms\Components\TextInput::make('footer_youtube')
                                ->label('Youtube Linki'),
                            ]),

                        ])->columns(4),
                    ])
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Başlık')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subdomain')
                    ->label('Alt Alan Adı')
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
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Kullanıcı')
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
            'index' => Pages\ListSites::route('/'),
            'create' => Pages\CreateSite::route('/create'),
            'edit' => Pages\EditSite::route('/{record}/edit'),
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
