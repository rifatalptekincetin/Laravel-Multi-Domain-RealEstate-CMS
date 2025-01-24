<?php

namespace App\Filament\Exports;

use App\Models\Report;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Filament\Actions\Exports\Enums\ExportFormat;

class ReportExporter extends Exporter
{
    protected static ?string $model = Report::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('site.title')
            ->label('Ofis'),
            ExportColumn::make('buyer_user.name')
            ->label('Alıcı Danışman'),
            ExportColumn::make('seller_user.name')
            ->label('Satıcı Danışman'),
            ExportColumn::make('property')
            ->label('Mülk'),
            ExportColumn::make('address')
            ->label('Adres'),
            ExportColumn::make('description')
            ->label('Açıklama'),
            ExportColumn::make('seller_name')
            ->label('Satıcı Adı'),
            ExportColumn::make('seller_email')
            ->label('Satıcı E-posta'),
            ExportColumn::make('seller_phone')
            ->label('Satıcı Tel'),
            ExportColumn::make('buyer_name')
            ->label('Alıcı Adı'),
            ExportColumn::make('buyer_email')
            ->label('Alıcı Eposta'),
            ExportColumn::make('buyer_phone')
            ->label('Alıcı Telefon'),
            ExportColumn::make('price')
            ->label('Fiyat'),
            ExportColumn::make('service_fee')
            ->label('Hizmet Bedeli'),
            ExportColumn::make('royalty_fee')
            ->label('Royalty Bedeli'),
            ExportColumn::make('selling_date')
            ->label('Satış Tarihi'),
            ExportColumn::make('attachments'),
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('created_at')
            ->label('Oluşturulma'),
            ExportColumn::make('updated_at')
            ->label('Güncellenme'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Dışa aktarma tamamlandı ve ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' dışa aktarıldı.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' dışa aktarılamadı.';
        }

        return $body;
    }

    public function getFormats(): array
    {
        return [
            ExportFormat::Xlsx,
            ExportFormat::Csv,
        ];
    }
}
