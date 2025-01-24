<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        
        $this->migrator->add('general.copyright');
        $this->migrator->add('general.copyright_menu_links');
        $this->migrator->add('general.footer_logo');
        $this->migrator->add('general.footer_description');
        $this->migrator->add('general.footer_menu_title');
        $this->migrator->add('general.footer_menu_links');
        $this->migrator->add('general.footer_contact_title');
        $this->migrator->add('general.footer_email');
        $this->migrator->add('general.footer_phone');
        $this->migrator->add('general.footer_address');
        $this->migrator->add('general.footer_facebook');
        $this->migrator->add('general.footer_instagram');
        $this->migrator->add('general.footer_linkedin');
        $this->migrator->add('general.footer_youtube');

    }
};
