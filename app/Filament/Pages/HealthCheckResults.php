<?php
 
namespace App\Filament\Pages;
 
use ShuvroRoy\FilamentSpatieLaravelHealth\Pages\HealthCheckResults as BaseHealthCheckResults;
 
class HealthCheckResults extends BaseHealthCheckResults
{
    protected static string $view = 'filament.pages.health-check-results';
    protected static ?int $navigationSort = 40;

    protected static ?string $navigationGroup = 'Ayarlar';

    public static function getNavigationGroup(): ?string
    {
        return 'Ayarlar';
    }

    public function getHeading(): string
    {
        return 'Site Sağlığı';
    }
}
