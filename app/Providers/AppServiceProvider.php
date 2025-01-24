<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Spatie\Health\Facades\Health;
use Spatie\Health\Checks\Checks\CacheCheck;
use Spatie\Health\Checks\Checks\OptimizedAppCheck;
use Spatie\Health\Checks\Checks\BackupsCheck;
use Spatie\CpuLoadHealthCheck\CpuLoadCheck;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use Spatie\Health\Checks\Checks\DatabaseConnectionCountCheck;
use Spatie\Health\Checks\Checks\DatabaseTableSizeCheck;
use Spatie\Health\Checks\Checks\DebugModeCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;
use Spatie\SecurityAdvisoriesHealthCheck\SecurityAdvisoriesCheck;
use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Health::checks([
            CacheCheck::new(),
            OptimizedAppCheck::new(),
            //BackupsCheck::new(),
            //CpuLoadCheck::new(),
            DatabaseCheck::new(),
            //DatabaseConnectionCountCheck::new(),
            DatabaseTableSizeCheck::new(),
            DebugModeCheck::new(),
            EnvironmentCheck::new(),
            SecurityAdvisoriesCheck::new(),
            UsedDiskSpaceCheck::new(),

        ]);
    }
}
