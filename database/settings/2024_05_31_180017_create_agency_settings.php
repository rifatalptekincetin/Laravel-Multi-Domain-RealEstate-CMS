<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.agencies_title');
        $this->migrator->add('general.agencies_description');
        $this->migrator->add('general.agencies_futured');
        $this->migrator->add('general.become_agency_image');
        $this->migrator->add('general.become_agency_title');
        $this->migrator->add('general.become_agency_button_text');
        $this->migrator->add('general.become_agency_button_url');
    }
};
