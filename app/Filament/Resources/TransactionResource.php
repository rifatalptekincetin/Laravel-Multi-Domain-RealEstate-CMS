<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\User;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-receipt-percent';

    protected static ?string $navigationLabel = 'Ödemeler';
    protected static ?string $modelLabel = 'Ödeme';
    protected static ?string $pluralModelLabel = 'Ödemeler';
    protected static ?int $navigationSort = 12;

    public static function getNavigationBadge(): ?string
    {
        if(static::getEloquentQuery()->whereIn('status',['pending','processing'])->count()){
            return static::getEloquentQuery()->whereIn('status',['pending','processing'])->count();
        }
        return Null;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([

                    /*
                    Forms\Components\Select::make('product_id')
                        ->label('İlgili Etkinlik')
                        ->relationship('product', 'title')
                        ->default(null),
                    */

                    Forms\Components\TextInput::make('title')
                        ->label('Başlık')
                        ->required(),

                    Forms\Components\Textarea::make('description')
                        ->label('Açıklama')
                        ->required(),

                    Forms\Components\Select::make('user_id')
                        ->label('Ödeme Yapacak Kullanıcı')
                        ->relationship('user', 'name')
                        ->default(null),

                    Forms\Components\Select::make('payment_method')
                    ->label("Ödeme Yöntemi")
                    ->options([
                        'offline'=>'Havale/Eft',
                    ])
                    ->default('offline'),

                    Forms\Components\Select::make('status')
                    ->label("Durum")
                    ->options([
                        'pending'=>'Bekleniyor',
                        'processing'=>'İşleniyor',
                        'completed'=>'Tamamlandı',
                        'canceled'=>'İptal Edildi',
                    ])
                    ->default('pending'),

                    Forms\Components\TextInput::make('price')
                        ->label('Toplam Ödeme')
                        ->numeric()
                        ->default(null)
                        ->prefix('₺'),
                    
                    /*
                    Forms\Components\Select::make('user_ids')
                        ->multiple()
                        ->label('Adına Ödeme Yapılan Kullanıcılar')
                        ->options(User::all()->pluck('name', 'id'))
                        ->searchable()
                        ->preload()
                        ->default(null),
                    */

                    Forms\Components\KeyValue::make('order_info')
                        ->label('Sipariş Bilgileri')
                        ->columnSpanFull(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label("Başlık")
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->label("Ödeme Yöntemi")
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label("Durum")
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'processing' => 'warning',
                        'completed' => 'success',
                        'canceled' => 'danger',
                    })
                    ->formatStateUsing(fn (string $state): string => [
                        'pending'=>'Bekleniyor',
                        'processing'=>'İşleniyor',
                        'completed'=>'Tamamlandı',
                        'canceled'=>'İptal Edildi',
                    ][$state])
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->label("Ödeme Tutarı")
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label("Oluşturulma T.")
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label("Güncellenme T.")
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
