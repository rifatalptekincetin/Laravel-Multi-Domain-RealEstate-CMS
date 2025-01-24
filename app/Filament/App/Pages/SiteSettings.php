<?php

namespace App\Filament\App\Pages;

use Illuminate\Database\Eloquent\Builder;

use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Support\Exceptions\Halt;

use Filament\Pages\Page;

use Filament\Actions\Action;
use Filament\Forms\Form;
use Filament\Forms;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use FilamentTiptapEditor\TiptapEditor;

use App\Models\Site;
use App\Models\User;
use App\Models\State;
use App\Models\City;
use App\Models\District;

use Filament\Notifications\Notification;

class SiteSettings extends Page implements HasForms
{
    use InteractsWithForms;
    public ?array $data = [];

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $view = 'filament.app.pages.site-settings';

    protected static ?int $navigationSort = 95;

    protected static ?string $navigationLabel = 'Site Ayarları';
    protected ?string $heading = 'Site Ayarları';

    public function mount(Site $record): void 
    {
        $this->form->fill(auth()->user()->sites()->first()->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Zorunlu Alanlar')
                ->description('Ofis Başlığı')
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Başlık')
                        ->maxLength(255),
                ])->columns(1),

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
                                        ->url()
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
                                        ->url()
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
            ])
            ->statePath('data')
            ->model(auth()->user()->sites()->first());
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('Kaydet'))
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        try {
            $data = $this->form->getState();
 
            auth()->user()->sites()->first()->update($data);
        } catch (Halt $exception) {
            return;
        }

        Notification::make() 
            ->success()
            ->title(__('Kaydedildi'))
            ->send(); 
    }

    public static function canAccess(): bool
    {
        return auth()->user()->sites()->count() > 0;
    }

}
