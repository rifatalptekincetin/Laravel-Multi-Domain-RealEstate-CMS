<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public ?string $copyright;
    public ?int $footer_logo;
    public ?string $footer_description;
    public ?string $footer_menu_title;
    public ?array $footer_menu_links;
    public ?string $footer_menu2_title;
    public ?array $footer_menu2_links;
    public ?string $footer_menu3_title;
    public ?array $footer_menu3_links;
    public ?string $footer_contact_title;
    public ?string $footer_email;
    public ?string $footer_phone;
    public ?string $footer_address;
    public ?string $footer_facebook;
    public ?string $footer_instagram;
    public ?string $footer_linkedin;
    public ?string $footer_youtube;
    public ?array $copyright_menu_links;
    public ?array $main_menu;
    public ?string $blogs_title;
    public ?string $blogs_description;
    public ?int $blogs_image;
    public ?string $agents_title;
    public ?string $agents_description;
    public ?array $agents_futured;
    public ?int $become_agent_image;
    public ?string $become_agent_title;
    public ?string $become_agent_button_text;
    public ?string $become_agent_button_url;

    public ?string $agencies_title;
    public ?string $agencies_description;
    public ?array $agencies_futured;
    public ?int $become_agency_image;
    public ?string $become_agency_title;
    public ?string $become_agency_button_text;
    public ?string $become_agency_button_url;

    public ?string $training_title;
    public ?string $training_description;
    public ?int $training_image;

    public ?string $seminar_title;
    public ?string $seminar_description;
    public ?int $seminar_image;

    public ?string $congress_title;
    public ?string $congress_description;
    public ?int $congress_image;

    public ?string $privacy_policy;

    public static function group(): string
    {
        return 'general';
    }
}