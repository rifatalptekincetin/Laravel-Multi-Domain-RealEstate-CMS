<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Awcodes\Curator\Components\Forms\CuratorPicker;

use App\Models\User;
use App\Models\Site;

use FilamentTiptapEditor\TiptapEditor;

class ManageSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = GeneralSettings::class;

    protected static ?int $navigationSort = 39;

    protected static ?string $navigationGroup = 'Ayarlar';
    protected static ?string $navigationLabel = 'Ayarları Yönet';
    protected ?string $heading = 'Ayarları Yönet';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Tabs')
                ->tabs([
                    Forms\Components\Tabs\Tab::make('KVKK')
                        ->schema([
                            TiptapEditor::make('privacy_policy')
                            ->label('Kvkk Metni')
                            ->columnSpanFull(),
                        ]),

                    Forms\Components\Tabs\Tab::make('Etkinlikler')
                        ->schema([
                            Forms\Components\Fieldset::make('Eğitimler')
                            ->schema([
                                CuratorPicker::make('training_image')
                                            ->label("Başlık Arkaplanı")
                                            ->columnSpanFull(),

                                Forms\Components\TextInput::make('training_title')
                                            ->label("Sayfa Başlığı")
                                            ->required(),

                                Forms\Components\Textarea::make('training_description')
                                            ->label("Açıklama")
                                            ->required(),
                            ]),

                            Forms\Components\Fieldset::make('Seminerler')
                            ->schema([
                                CuratorPicker::make('seminar_image')
                                            ->label("Başlık Arkaplanı")
                                            ->columnSpanFull(),

                                Forms\Components\TextInput::make('seminar_title')
                                            ->label("Sayfa Başlığı")
                                            ->required(),

                                Forms\Components\Textarea::make('seminar_description')
                                            ->label("Açıklama")
                                            ->required(),
                            ]),

                            Forms\Components\Fieldset::make('Kongreler')
                            ->schema([
                                CuratorPicker::make('congress_image')
                                            ->label("Başlık Arkaplanı")
                                            ->columnSpanFull(),

                                Forms\Components\TextInput::make('congress_title')
                                            ->label("Sayfa Başlığı")
                                            ->required(),

                                Forms\Components\Textarea::make('congress_description')
                                            ->label("Açıklama")
                                            ->required(),
                            ]),
                        ]),

                    Forms\Components\Tabs\Tab::make('Ofisler')
                        ->schema([
                            Forms\Components\TextInput::make('agencies_title')
                                            ->label("Başlık")
                                            ->required(),
                            Forms\Components\Textarea::make('agencies_description')
                                            ->label("Açıklama")
                                            ->required(),
                                            
                            Forms\Components\Select::make('agencies_futured')
                            ->label('Öne Çıkan Ofisler')
                            ->options(Site::all()->pluck('title', 'id'))
                            ->multiple()
                            ->searchable(),

                            Forms\Components\Fieldset::make('Franchise Başvurusu')
                            ->schema([
                                CuratorPicker::make('become_agency_image')
                                            ->label("Arkaplan")
                                            ->columnSpanFull(),
                                Forms\Components\TextInput::make('become_agency_title')
                                            ->label("Başlık")
                                            ->required(),
                                Forms\Components\TextInput::make('become_agency_button_text')
                                            ->label("Buton Yazısı")
                                            ->required(),
                                Forms\Components\TextInput::make('become_agency_button_url')
                                            ->label("Buton Linki")
                                            ->required(),
                            ]),

                        ]),
                    Forms\Components\Tabs\Tab::make('Danışmanlar')
                        ->schema([
                            Forms\Components\TextInput::make('agents_title')
                                            ->label("Başlık")
                                            ->required(),
                            Forms\Components\Textarea::make('agents_description')
                                            ->label("Açıklama")
                                            ->required(),
                                            
                            Forms\Components\Select::make('agents_futured')
                            ->label('Öne Çıkan Danışmanlar')
                            ->options(User::all()->pluck('name', 'id'))
                            ->multiple()
                            ->searchable(),

                            Forms\Components\Fieldset::make('Danışman Ol')
                            ->schema([
                                CuratorPicker::make('become_agent_image')
                                            ->label("Arkaplan")
                                            ->columnSpanFull(),
                                Forms\Components\TextInput::make('become_agent_title')
                                            ->label("Başlık")
                                            ->required(),
                                Forms\Components\TextInput::make('become_agent_button_text')
                                            ->label("Buton Yazısı")
                                            ->required(),
                                Forms\Components\TextInput::make('become_agent_button_url')
                                            ->label("Buton Linki")
                                            ->required(),
                            ]),

                        ]),
                    Forms\Components\Tabs\Tab::make('Menu')
                        ->schema([
                            Forms\Components\Section::make('Menu')->schema([
                                Forms\Components\Repeater::make('main_menu')
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
                        ]),

                    Forms\Components\Tabs\Tab::make('Blog')
                        ->schema([
                            CuratorPicker::make('blogs_image')
                                            ->label("Blog Sayfası Arkaplan")
                                            ->columnSpanFull(),

                            Forms\Components\TextInput::make('blogs_title')
                                            ->label("Sayfa Başlığı")
                                            ->required(),

                            Forms\Components\Textarea::make('blogs_description')
                                            ->label("Açıklama")
                                            ->required(),
                        ]),

                    Forms\Components\Tabs\Tab::make('Footer')
                        ->schema([
                            Forms\Components\Section::make('Column 1')->schema([
                                CuratorPicker::make('footer_logo')
                                            ->label("Footer Logo")
                                            ->columnSpanFull(),

                                TiptapEditor::make('footer_description')
                                            ->label('Logo Altı Açıklama'),
                                
                                
                            ]),

                            Forms\Components\Section::make('Column 2')->schema([
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

                            Forms\Components\Section::make('Column 3')->schema([
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

                            Forms\Components\Section::make('Column 4')->schema([
                                Forms\Components\TextInput::make('footer_menu3_title')
                                ->label('Menu3 Başlığı'),

                                Forms\Components\Repeater::make('footer_menu3_links')
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

                            Forms\Components\Section::make('Column 5')->schema([
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
                                ->label('Twitter Linki'),

                                Forms\Components\TextInput::make('footer_youtube')
                                ->label('Youtube Linki'),
                            ]),
                            
                            Forms\Components\Section::make('Copyright')->schema([
                                Forms\Components\TextInput::make('copyright')
                                    ->label('Copyright yazısı'),
                                Forms\Components\Repeater::make('copyright_menu_links')
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

                        ]),

                    ])->columnSpanFull(),
            ]);
    }
}
