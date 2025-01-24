<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.footer_menu2_title');
        $this->migrator->add('general.footer_menu2_links');
    }
};
