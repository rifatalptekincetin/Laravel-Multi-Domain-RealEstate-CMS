<?php

namespace App\Filament\App\Pages;

use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Support\Exceptions\Halt;

use Filament\Pages\Page;

use Filament\Actions\Action;
use Filament\Forms\Form;
use Filament\Forms;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use FilamentTiptapEditor\TiptapEditor;

use App\Models\User;

use Filament\Notifications\Notification;

class MyProfile extends Page implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static string $view = 'filament.app.pages.my-profile';

    protected static ?int $navigationSort = 100;
    
    protected static ?string $navigationLabel = 'Profilim';
    protected ?string $heading = 'Profilim';

    public function mount(User $record): void 
    {
        $this->form->fill(auth()->user()->toArray());
    }
 
    public function form(Form $form): Form
    {
        return $form
            ->schema([
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
                    Forms\Components\TextInput::make('name')
                                ->label('İsim')
                                ->required()
                                ->maxLength(255),
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
            ])
            ->statePath('data')
            ->model(auth()->user());
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
 
            auth()->user()->update($data);
        } catch (Halt $exception) {
            return;
        }

        Notification::make() 
            ->success()
            ->title(__('Kaydedildi'))
            ->send(); 
    }
}
