<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.blogs_title');
        $this->migrator->add('general.blogs_description');
        $this->migrator->add('general.blogs_image');
    }
};
