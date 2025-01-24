<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Models\Page;
use App\Models\User;
use App\Models\Site;
use App\Models\ListingCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Grid;
use Filament\Forms\Set;
use Illuminate\Support\Str;

use FilamentTiptapEditor\TiptapEditor;

use Awcodes\Curator\Components\Forms\CuratorPicker;

use Filament\Forms\Components\Builder;

use Filament\Forms\Components\Section;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationLabel = 'Sayfalar';
    protected static ?string $modelLabel = 'Sayfa';
    protected static ?string $pluralModelLabel = 'Sayfalar';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make([
                    'default' => 1,
                    'sm' => 2,
                    'md' => 4,
                    'lg' => 4,
                    'xl' => 4,
                    '2xl' => 4,
                ])->schema([
                    Section::make([
                        'default' => 1,
                        'sm' => 2,
                        'md' => 4,
                        'lg' => 4,
                    ])->schema([
                        Forms\Components\TextInput::make('title')
                            ->maxLength(255)
                            ->columnSpan([
                                "md"=>2,
                                "lg"=>2,
                            ]),
                        Forms\Components\TextInput::make('slug')
                            ->maxLength(255)
                            ->columnSpan([
                                "md"=>2,
                                "lg"=>2,
                            ]),
                        Builder::make('content')
                            ->label('İçerik')
                            ->blocks([
                                Builder\Block::make('slider')
                                ->label('Kaydırak')
                                ->schema([
                                    Forms\Components\Repeater::make('slide')
                                    ->label('Kaydırak İçeriği')
                                    ->schema([
                                        CuratorPicker::make('image_id')
                                        ->label("Arkaplan")
                                        ->columnSpanFull(),
                                        Forms\Components\TextInput::make('title')
                                        ->label("Başlık")
                                        ->required(),
                                        Forms\Components\Textarea::make('description')
                                        ->label("Açıklama"),
                                        Forms\Components\TextInput::make('button_text')
                                        ->label("Buton Metni")
                                        ->required(),
                                        Forms\Components\TextInput::make('button_link')
                                        ->label("Buton Linki")
                                        ->required(),
                                    ])
                                    ->columns(2),
                                ]),


                                Builder\Block::make('hero')
                                ->label('Hero')
                                ->schema([
                                    Forms\Components\Repeater::make('slide')
                                    ->label('Arkaplan')
                                    ->schema([
                                        CuratorPicker::make('image_id')
                                        ->label("Resim")
                                        ->columnSpanFull(),
                                    ])
                                    ->grid(2),
                                    Forms\Components\Repeater::make('buttons')
                                    ->label('Butonlar')
                                    ->schema([
                                        CuratorPicker::make('image_id')
                                        ->label("Icon")
                                        ->columnSpanFull(),
                                        Forms\Components\TextInput::make('title')
                                        ->label("Başlık"),
                                        Forms\Components\TextInput::make('link')
                                        ->label("Link"),
                                    ])
                                    ->grid(3),

                                ]),

                                Builder\Block::make('banners')
                                ->label('Bannerlar')
                                ->schema([
                                    Forms\Components\Repeater::make('banner')
                                    ->label('Banner İçeriği')
                                    ->schema([
                                        CuratorPicker::make('image_id')
                                        ->label("Banner Resmi")
                                        ->columnSpanFull(),
                                        Forms\Components\TextInput::make('banner_link')
                                        ->label("Banner Linki")
                                        ->columnSpanFull()
                                        ->required(),
                                    ]),
                                ]),

                                Builder\Block::make('text')
                                ->label('Metin')
                                ->schema([
                                    TiptapEditor::make('text')->label("Metin")->required(),
                                ]),

                                Builder\Block::make('listings')
                                ->label('İlanlar')
                                ->schema([
                                    Forms\Components\TextInput::make('title')
                                    ->label("Başlık")
                                    ->required(),
                                    Forms\Components\Textarea::make('description')->label("Açıklama")->required(),
                                    Forms\Components\Select::make('category_ids')
                                    ->label('Kategoriler')
                                    ->multiple()
                                    ->options(ListingCategory::where('parent_id',0)->pluck('title', 'id'))
                                    ->searchable(),
                                    Forms\Components\TextInput::make('number_of_listing')
                                    ->label("İlan Sayısı")
                                    ->numeric()->step(1)->minValue(3)->required(),
                                ]),

                                Builder\Block::make('subscribe')
                                ->label('Abone Ol')
                                ->schema([
                                    Forms\Components\TextInput::make('title')
                                    ->label("Başlık")
                                    ->required(),
                                    Forms\Components\Textarea::make('description')->label("Açıklama"),
                                    Forms\Components\TextInput::make('input_placeholder')
                                    ->label("Girdi Metni")
                                    ->required(),
                                    Forms\Components\TextInput::make('button_text')
                                    ->label("Buton Metni")
                                    ->required(),
                                ]),

                                Builder\Block::make('latest_news')
                                ->label('Son Haberler')
                                ->schema([
                                    Forms\Components\TextInput::make('title')
                                    ->label("Başlık")
                                    ->required(),
                                    Forms\Components\Textarea::make('description')->label("Açıklama"),
                                    Forms\Components\TextInput::make('number_of_news')
                                    ->label("Haber Sayısı")
                                    ->numeric()->step(1)->minValue(3)->required(),
                                ]),

                                Builder\Block::make('cta')
                                ->label('Eylem Çağrısı')
                                ->schema([
                                    CuratorPicker::make('image_id')
                                        ->label("Arkaplan")
                                        ->columnSpanFull(),
                                    Forms\Components\TextInput::make('title')
                                    ->label("Başlık")
                                    ->required(),
                                    Forms\Components\Textarea::make('description')
                                    ->label("Açıklama"),
                                    Forms\Components\TextInput::make('button_text')
                                    ->label("Buton Metni")
                                    ->required(),
                                    Forms\Components\TextInput::make('button_link')
                                    ->label("Buton Linki")
                                    ->required(),
                                ]),

                                Builder\Block::make('image_cta')
                                ->label('Resim ve Metin')
                                ->schema([
                                    CuratorPicker::make('image_id')
                                        ->label("Resim")
                                        ->columnSpanFull(),
                                    TiptapEditor::make('description')
                                        ->label("İçerik"),
                                    Forms\Components\TextInput::make('button_text')
                                    ->label("Buton Metni")
                                    ->required(),
                                    Forms\Components\TextInput::make('button_link')
                                    ->label("Buton Linki")
                                    ->required(),
                                    Forms\Components\Radio::make('image_position')
                                    ->label('Resim Pozisyonu')
                                    ->options([
                                        'left' => 'Sol',
                                        'right' => 'Sağ',
                                    ])->columns(2),
                                ]),

                                Builder\Block::make('iframe_cta')
                                ->label('Iframe ve Metin')
                                ->schema([
                                    Forms\Components\Textarea::make('iframe')
                                    ->label("Iframe Kodu")
                                    ->required(),

                                    TiptapEditor::make('description')
                                        ->label("İçerik"),

                                    Forms\Components\TextInput::make('button_text')
                                    ->label("Buton Metni")
                                    ->required(),
                                    Forms\Components\TextInput::make('button_link')
                                    ->label("Buton Linki")
                                    ->required(),
                                    Forms\Components\Radio::make('image_position')
                                    ->label('Iframe Pozisyonu')
                                    ->options([
                                        'left' => 'Sol',
                                        'right' => 'Sağ',
                                    ])->columns(2),
                                ]),

                                Builder\Block::make('locations')
                                ->label('Konumlar')
                                ->schema([
                                    Forms\Components\TextInput::make('title')
                                    ->label("Başlık")
                                    ->required(),
                                    Forms\Components\Textarea::make('description')
                                    ->label("Açıklama"),
                                    Forms\Components\Repeater::make('location')
                                    ->label('Konum')
                                    ->schema([
                                        CuratorPicker::make('image_id')
                                        ->label("Arkaplan")
                                        ->columnSpanFull(),
                                        Forms\Components\TextInput::make('title')
                                        ->label("Başlık")
                                        ->required(),
                                        Forms\Components\Textarea::make('description')
                                        ->label("Açıklama"),
                                        Forms\Components\TextInput::make('button_text')
                                        ->label("Buton Metni"),
                                        Forms\Components\TextInput::make('button_link')
                                        ->label("Buton Linki"),
                                    ])
                                    ->columns(2),
                                ]),

                                Builder\Block::make('form')
                                ->label('Tam Genişlik Form')
                                ->schema([
                                    Forms\Components\TextInput::make('title')
                                    ->label("Başlık"),
                                    Forms\Components\Textarea::make('description')
                                    ->label("Açıklama"),
                                    Forms\Components\Repeater::make('form_fields')
                                    ->label('Form Alanları')
                                    ->schema([
                                        Forms\Components\TextInput::make('label')
                                        ->label('Etiket')
                                        ->columnSpan(3)
                                        ->required(),
                                        Forms\Components\TextInput::make('helper')
                                        ->columnSpan(3)
                                        ->label('Yardımcı Metin'),
                                        Forms\Components\Select::make('type')
                                        ->label('Tip')
                                        ->columnSpan(2)
                                        ->options([
                                            'text' => 'Yazı',
                                            'number' => 'Sayı',
                                            'email' => 'Email',
                                            'textarea' => 'Uzun Yazı',
                                            'checkbox' => 'Checkbox',
                                        ])
                                        ->required()
                                        ->default('text'),
                                        Forms\Components\Select::make('column')
                                        ->label('Genişlik')
                                        ->columnSpan(2)
                                        ->options([
                                            '2' => '%17',
                                            '3' => '%25',
                                            '4' => '%33',
                                            '6' => '%50',
                                            '8' => '%67',
                                            '9' => '%75',
                                            '10' => '%83',
                                            '12' => '%100',
                                        ])
                                        ->required()
                                        ->default('6'),
                                        Forms\Components\Checkbox::make('required')
                                        ->label('Zorunlu')
                                        ->columnSpan(2)
                                        ->inline(),
                                    ])
                                    ->columns(6),
                                ]),

                                Builder\Block::make('offices')
                                ->label('Ofisler')
                                ->schema([
                                    Forms\Components\TextInput::make('title')
                                    ->label("Başlık")
                                    ->required(),
                                    Forms\Components\Textarea::make('description')
                                    ->label("Açıklama"),
                                    Forms\Components\Select::make('site_ids')
                                    ->label('Ofisler (Tümü için boş bırakın)')
                                    ->options(Site::all()->pluck('title', 'id'))
                                    ->multiple()
                                    ->searchable(),
                                ]),

                                Builder\Block::make('team_mates')
                                ->label('Takım Arkadaşları')
                                ->schema([
                                    Forms\Components\TextInput::make('title')
                                    ->label("Başlık")
                                    ->required(),
                                    Forms\Components\Textarea::make('description')
                                    ->label("Açıklama"),
                                    Forms\Components\Select::make('user_ids')
                                    ->label('Danışmanlar (Tümü için boş bırakın)')
                                    ->options(User::all()->pluck('name', 'id'))
                                    ->multiple()
                                    ->searchable(),
                                ]),

                                Builder\Block::make('why_choose_us')
                                ->label('Neden Biz')
                                ->schema([
                                    Forms\Components\TextInput::make('title')
                                    ->label("Başlık")
                                    ->required(),
                                    Forms\Components\Textarea::make('description')
                                    ->label("Açıklama"),
                                    Forms\Components\Repeater::make('item')
                                    ->label('Neden')
                                    ->schema([
                                        CuratorPicker::make('image_id')
                                        ->label("İcon")
                                        ->columnSpanFull(),
                                        Forms\Components\TextInput::make('title')
                                        ->label("Başlık")
                                        ->required(),
                                        Forms\Components\Textarea::make('description')
                                        ->label("Açıklama"),
                                    ])
                                    ->columns(2),
                                ]),

                                Builder\Block::make('testimonials')
                                ->label('Yorumlar')
                                ->schema([
                                    Forms\Components\TextInput::make('title')
                                    ->label("Başlık")
                                    ->required(),
                                    Forms\Components\Textarea::make('description')
                                    ->label("Açıklama"),
                                    Forms\Components\Repeater::make('testimonial')
                                    ->label('Yorum')
                                    ->schema([
                                        CuratorPicker::make('image_id')
                                        ->label("İcon")
                                        ->columnSpanFull(),
                                        Forms\Components\TextInput::make('name')
                                        ->label("İsim")
                                        ->required(),
                                        Forms\Components\TextInput::make('title')
                                        ->label("Başlık")
                                        ->required(),
                                        Forms\Components\Textarea::make('review')
                                        ->label("Görüş")
                                        ->columnSpanFull(),
                                    ])->grid(2),
                                ]),

                                Builder\Block::make('contact_info')
                                ->label('İletişim Bilgileri')
                                ->schema([
                                    Forms\Components\TextInput::make('phone')->label("Telefon")->required(),
                                    Forms\Components\TextInput::make('email')->label("E-posta")->required(),
                                    Forms\Components\TextInput::make('address')->label("Adres")->required(),
                                ]),

                                Builder\Block::make('contact')
                                ->label('İletişim Formu')
                                ->schema([
                                    Forms\Components\TextInput::make('title')
                                    ->label("Başlık"),
                                    TiptapEditor::make('description')
                                    ->label("İçerik"),
                                    Forms\Components\Repeater::make('form_fields')
                                    ->label('Form Alanları')
                                    ->schema([
                                        Forms\Components\TextInput::make('label')
                                        ->label('Etiket')
                                        ->required(),
                                        Forms\Components\Select::make('type')
                                        ->label('Tip')
                                        ->options([
                                            'text' => 'Yazı',
                                            'number' => 'Sayı',
                                            'email' => 'Email',
                                            'textarea' => 'Uzun Yazı',
                                            'checkbox' => 'Checkbox',
                                        ])
                                        ->required()
                                        ->default('text'),
                                        Forms\Components\Checkbox::make('required')->label('Zorunlu')
                                        ->inline(),
                                    ])
                                    ->columns(3),
                                ]),

                                Builder\Block::make('faq')
                                ->label('SSS')
                                ->schema([
                                    Forms\Components\Checkbox::make('is_navigation')->label('Navigasyon Kullan')
                                        ->inline(),
                                    Forms\Components\TextInput::make('navigation_title')
                                    ->label("Navigasyon Başlığı"),
                                    Forms\Components\Repeater::make('faq_section')
                                    ->label('Soru Grubu')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                        ->label("Başlık")
                                        ->required(),
                                        Forms\Components\Repeater::make('faq')
                                        ->label('Soru')
                                        ->schema([
                                            Forms\Components\TextInput::make('question')
                                            ->label('Soru')
                                            ->required(),
                                            TiptapEditor::make('answer')
                                            ->label('Cevap')
                                            ->required(),
                                        ])
                                        ->columns(1),
                                    ])
                                ]),

                                Builder\Block::make('title_section')
                                ->label('Başlık Bölümü')
                                ->schema([
                                    CuratorPicker::make('image_id')
                                    ->label("Arkaplan")
                                    ->columnSpanFull(),
                                    Forms\Components\TextInput::make('title')
                                    ->label("Başlık")
                                    ->required(),
                                    Forms\Components\Textarea::make('description')
                                    ->label("Açıklama"),
                                ]),
                            ]),
                    ])->columnSpan([
                        "md"=>3,
                        "lg"=>3,
                    ]),
                    Section::make()->schema([
                        Forms\Components\Select::make('status')
                            ->label('Durum')
                            ->options([
                                'draft' => 'Taslak',
                                'published' => 'Yayında',
                            ])
                            ->required()
                            ->default('draft'),
                        Forms\Components\Select::make('site_id')
                            ->label('Site (ana site için boş bırakın)')
                            ->relationship(
                                'site',
                                'title',
                            ),
                        Forms\Components\TextInput::make('meta_title')
                            ->label('Meta Başlığı')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('meta_description')
                            ->label('Meta Açıklaması')
                            ->maxLength(255),
                        
                    ])->columnSpan([
                        "md"=>1,
                        "lg"=>1,
                    ]),
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
                Tables\Columns\TextColumn::make('site.subdomain')
                    ->label('Ofis')
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
                Tables\Filters\SelectFilter::make('site')->relationship('site', 'subdomain')
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): EloquentBuilder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
