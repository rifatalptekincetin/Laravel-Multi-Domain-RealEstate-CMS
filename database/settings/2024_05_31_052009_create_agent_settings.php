<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.agents_title');
        $this->migrator->add('general.agents_description');
        $this->migrator->add('general.agents_futured');
        $this->migrator->add('general.become_agent_image');
        $this->migrator->add('general.become_agent_title');
        $this->migrator->add('general.become_agent_button_text');
        $this->migrator->add('general.become_agent_button_url');
    }
};
