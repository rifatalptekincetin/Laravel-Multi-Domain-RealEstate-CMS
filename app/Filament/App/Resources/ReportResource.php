<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\ReportResource\Pages;
use App\Filament\App\Resources\ReportResource\RelationManagers;
use App\Models\Report;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationLabel = 'İşlem Bildirimleri';
    protected static ?string $modelLabel = 'İşlem Bildirimi';
    protected static ?string $pluralModelLabel = 'İşlem Bildirimleri';
    protected static ?int $navigationSort = 11;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Ofis & Danışman')
                ->schema([
                    Forms\Components\Select::make('site_id')
                        ->label('Ofis')
                        ->relationship('site', 'title',
                        modifyQueryUsing: function (EloquentBuilder $query){
                            return $query->where('user_id', auth()->id());
                        }),
                    Forms\Components\Select::make('seller_user_id')
                        ->label('Satıcı ile ilg. danışman')
                        ->relationship('seller_user', 'name',
                        function (Builder $query){
                            if(auth()->user()->sites()->count()) return $query->where('site_id',auth()->user()->site_id);
                            return $query->where('id',auth()->user()->id);
                        }),
                    Forms\Components\Select::make('buyer_user_id')
                        ->label('Alıcı ile ilg. danışman')
                        ->relationship('buyer_user', 'name',
                        function (Builder $query){
                            if(auth()->user()->sites()->count()) return $query->where('site_id',auth()->user()->site_id);
                            return $query->where('id',auth()->user()->id);
                        }),
                ])
                ->columns(['sm' => 1,'md' => 3]),

                Forms\Components\Section::make('Gayrimenkul Bilgileri')
                ->schema([
                    Forms\Components\TextInput::make('property')
                        ->label('Gayrimenkul Adı')
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\TextInput::make('address')
                        ->label('Adresi')
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\DatePicker::make('selling_date')
                        ->default(date("d-m-Y"))
                        ->label('Satış\Kiralama T.')
                        ->format('d-m-Y'),
                    Forms\Components\Textarea::make('description')
                        ->label('Ek açıklama')
                        ->maxLength(255)
                        ->columnSpanFull()
                        ->default(null),
                ])
                ->columns(['sm' => 1,'md' => 3]),

                Forms\Components\Section::make('Satıcı Bilgileri')
                ->schema([
                    Forms\Components\TextInput::make('seller_name')
                        ->label('Tam Adı')
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\TextInput::make('seller_email')
                        ->label('E-posta Adresi')
                        ->email()
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\TextInput::make('seller_phone')
                        ->label('Telefon Numarası')
                        ->tel()
                        ->maxLength(255)
                        ->default(null),
                ])
                ->columns(['sm' => 1,'md' => 3]),

                Forms\Components\Section::make('Alıcı Bilgileri')
                ->schema([
                    Forms\Components\TextInput::make('buyer_name')
                        ->label('Tam Adı')
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\TextInput::make('buyer_email')
                        ->label('E-posta Adresi')
                        ->email()
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\TextInput::make('buyer_phone')
                        ->label('Telefon Numarası')
                        ->tel()
                        ->maxLength(255)
                        ->default(null),
                ])
                ->columns(['sm' => 1,'md' => 3]),

                Forms\Components\Section::make('Fiyat Bilgileri')
                ->schema([
                    Forms\Components\TextInput::make('price')
                        ->label("Satış/Kira Bedeli")
                        ->numeric()
                        ->default(null)
                        ->suffix('₺'),
                    Forms\Components\TextInput::make('service_fee')
                        ->label("Hizmet Bedeli (KDV Hariç)")
                        ->numeric()
                        ->default(null)
                        ->suffix('₺')
                        ->reactive()
                        ->debounce(600)
                        ->afterStateUpdated(function ($set, $state) {
                            $set('royalty_fee', $state * 0.05);
                        }),
                    Forms\Components\TextInput::make('royalty_fee')
                        ->label("Royalty Bedeli (KDV Hariç)")
                        ->numeric()
                        ->default(null)
                        ->suffix('₺'),
                ])
                ->columns(['sm' => 1,'md' => 3]),

                Forms\Components\Section::make('Dosyalar')
                ->schema([
                    Forms\Components\FileUpload::make('attachments')
                        ->label("")
                        ->multiple(),
                ])
                ->columns(['sm' => 1]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('site.title')
                    ->label('Ofis')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('property')
                    ->label('Gayrimenkul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->label('Adres')
                    ->searchable(),
                Tables\Columns\TextColumn::make('seller_name')
                    ->label('Satıcı')
                    ->searchable(),
                Tables\Columns\TextColumn::make('buyer_name')
                    ->label('Alıcı')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Fiyat')
                    ->sortable(),
                Tables\Columns\TextColumn::make('service_fee')
                    ->label('Hizmet Bedeli')
                    ->sortable(),
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
            'index' => Pages\ListReports::route('/'),
            'create' => Pages\CreateReport::route('/create'),
            'edit' => Pages\EditReport::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): EloquentBuilder
    {
        return parent::getEloquentQuery()
            ->whereIn('site_id', auth()->user()->sites->pluck('id')->toArray());
    }

    public static function canAccess(): bool
    {
        return auth()->user()->sites()->count() > 0;
    }
}
