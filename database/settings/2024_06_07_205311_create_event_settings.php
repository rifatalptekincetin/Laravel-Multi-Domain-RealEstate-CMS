<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.training_title');
        $this->migrator->add('general.training_description');
        $this->migrator->add('general.training_image');

        $this->migrator->add('general.seminar_title');
        $this->migrator->add('general.seminar_description');
        $this->migrator->add('general.seminar_image');

        $this->migrator->add('general.congress_title');
        $this->migrator->add('general.congress_description');
        $this->migrator->add('general.congress_image');
    }
};
