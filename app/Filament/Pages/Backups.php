<?php

namespace App\Filament\Pages;

use ShuvroRoy\FilamentSpatieLaravelBackup\Pages\Backups as BaseBackups;

class Backups extends BaseBackups
{
    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';

    protected static ?int $navigationSort = 35;

    protected static ?string $navigationGroup = 'Ayarlar';

    public function getHeading(): string
    {
        return 'Yedeklemeler';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Ayarlar';
    }
}