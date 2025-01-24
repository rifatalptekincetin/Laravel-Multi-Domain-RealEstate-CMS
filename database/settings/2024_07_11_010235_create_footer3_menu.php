<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;
//database/settings/2024_07_11_010235_create_footer3_menu.php
return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.footer_menu3_title');
        $this->migrator->add('general.footer_menu3_links');
    }
};
