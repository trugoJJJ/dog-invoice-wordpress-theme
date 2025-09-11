<?php
/**
 * ACF Field Groups for DogInvoice Theme
 * Works with both ACF Free and ACF Pro
 */

// Check if ACF is active
if (!function_exists('acf_add_local_field_group')) {
    return;
}

// Hero Section Fields
acf_add_local_field_group(array(
    'key' => 'group_hero_section',
    'title' => 'Hero Section',
    'fields' => array(
        array(
            'key' => 'field_hero_title',
            'label' => 'Tytuł główny',
            'name' => 'hero_title',
            'type' => 'text',
            'instructions' => 'Główny tytuł sekcji hero',
            'required' => 1,
            'default_value' => 'Robisz zdjęcie faktury, a reszta dzieje się automatycznie',
        ),
        array(
            'key' => 'field_hero_subtitle',
            'label' => 'Podtytuł',
            'name' => 'hero_subtitle',
            'type' => 'textarea',
            'instructions' => 'Krótki opis pod tytułem',
            'rows' => 3,
            'default_value' => 'DogInvoice automatycznie organizuje Twoje dokumenty, eliminuje chaos administracyjny i pozwala Ci skupić się na tym, co naprawdę ważne.',
        ),
        array(
            'key' => 'field_hero_description',
            'label' => 'Opis',
            'name' => 'hero_description',
            'type' => 'textarea',
            'instructions' => 'Dłuższy opis (opcjonalny)',
            'rows' => 4,
        ),
        array(
            'key' => 'field_hero_video_url',
            'label' => 'URL Video',
            'name' => 'hero_video_url',
            'type' => 'url',
            'instructions' => 'Link do video w tle sekcji hero',
            'default_value' => '/videos/doginvoice_hero.mp4',
        ),
        array(
            'key' => 'field_hero_video_poster',
            'label' => 'Poster Video',
            'name' => 'hero_video_poster',
            'type' => 'image',
            'instructions' => 'Obrazek wyświetlany przed załadowaniem video',
            'return_format' => 'url',
            'default_value' => '/doginvoice_hero_frame.png',
        ),
        array(
            'key' => 'field_hero_cta_primary_text',
            'label' => 'Tekst przycisku głównego',
            'name' => 'hero_cta_primary_text',
            'type' => 'text',
            'default_value' => 'Wybierz swój plan',
        ),
        array(
            'key' => 'field_hero_cta_primary_url',
            'label' => 'URL przycisku głównego',
            'name' => 'hero_cta_primary_url',
            'type' => 'url',
            'default_value' => '#pricing',
        ),
        array(
            'key' => 'field_hero_cta_secondary_text',
            'label' => 'Tekst przycisku drugiego',
            'name' => 'hero_cta_secondary_text',
            'type' => 'text',
            'default_value' => 'Przetestuj za darmo',
        ),
        array(
            'key' => 'field_hero_cta_secondary_url',
            'label' => 'URL przycisku drugiego',
            'name' => 'hero_cta_secondary_url',
            'type' => 'url',
            'default_value' => '/trial',
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'doginvoice_hero',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
));

// Process Steps Fields
acf_add_local_field_group(array(
    'key' => 'group_process_steps',
    'title' => 'Kroki procesu',
    'fields' => array(
        array(
            'key' => 'field_step_number',
            'label' => 'Numer kroku',
            'name' => 'step_number',
            'type' => 'text',
            'instructions' => 'Numer kroku (np. 01, 02, 03)',
            'required' => 1,
            'maxlength' => 2,
        ),
        array(
            'key' => 'field_step_icon',
            'label' => 'Ikona',
            'name' => 'step_icon',
            'type' => 'select',
            'instructions' => 'Wybierz ikonę dla kroku',
            'required' => 1,
            'choices' => array(
                'upload' => 'Upload (Wielokanałowy odbiór)',
                'check-circle' => 'Check Circle (Weryfikacja)',
                'brain' => 'Brain (Analiza AI)',
                'folder-open' => 'Folder Open (Archiwizacja)',
                'bar-chart-3' => 'Bar Chart (Dashboard)',
            ),
            'default_value' => 'upload',
        ),
        array(
            'key' => 'field_step_video_url',
            'label' => 'URL Video',
            'name' => 'step_video_url',
            'type' => 'url',
            'instructions' => 'Link do video demonstracyjnego',
        ),
        array(
            'key' => 'field_step_position_x',
            'label' => 'Pozycja X (%)',
            'name' => 'step_position_x',
            'type' => 'number',
            'instructions' => 'Pozycja pozioma kroku na ścieżce (0-100)',
            'min' => 0,
            'max' => 100,
            'step' => 1,
            'default_value' => 50,
        ),
        array(
            'key' => 'field_step_position_y',
            'label' => 'Pozycja Y (%)',
            'name' => 'step_position_y',
            'type' => 'number',
            'instructions' => 'Pozycja pionowa kroku na ścieżce (0-100)',
            'min' => 0,
            'max' => 100,
            'step' => 1,
            'default_value' => 50,
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'process_steps',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
));

// Features Fields
acf_add_local_field_group(array(
    'key' => 'group_features',
    'title' => 'Funkcjonalności',
    'fields' => array(
        array(
            'key' => 'field_feature_icon',
            'label' => 'Ikona',
            'name' => 'feature_icon',
            'type' => 'select',
            'instructions' => 'Wybierz ikonę dla funkcjonalności',
            'required' => 1,
            'choices' => array(
                'zap' => 'Zap (Automatyzacja)',
                'settings' => 'Settings (Analiza finansowa)',
                'trending-up' => 'Trending Up (Wzrost)',
                'shield' => 'Shield (Bezpieczeństwo)',
                'clock' => 'Clock (Czas rzeczywisty)',
            ),
            'default_value' => 'zap',
        ),
        array(
            'key' => 'field_feature_video_url',
            'label' => 'URL Video',
            'name' => 'feature_video_url',
            'type' => 'url',
            'instructions' => 'Link do video demonstracyjnego',
        ),
        array(
            'key' => 'field_feature_highlight',
            'label' => 'Podświetlenie',
            'name' => 'feature_highlight',
            'type' => 'text',
            'instructions' => 'Krótki tekst podświetlający (np. "Auto-categorize")',
            'maxlength' => 20,
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'features',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
));

// Integrations Fields
acf_add_local_field_group(array(
    'key' => 'group_integrations',
    'title' => 'Integracje',
    'fields' => array(
        array(
            'key' => 'field_integration_logo',
            'label' => 'Logo',
            'name' => 'integration_logo',
            'type' => 'image',
            'instructions' => 'Logo integracji',
            'required' => 1,
            'return_format' => 'url',
        ),
        array(
            'key' => 'field_integration_url',
            'label' => 'URL',
            'name' => 'integration_url',
            'type' => 'url',
            'instructions' => 'Link do strony integracji',
        ),
        array(
            'key' => 'field_integration_coming_soon',
            'label' => 'Wkrótce',
            'name' => 'integration_coming_soon',
            'type' => 'true_false',
            'instructions' => 'Czy integracja jest w fazie "wkrótce"?',
            'default_value' => 0,
            'ui' => 1,
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'integrations',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
));

// Benefits Fields
acf_add_local_field_group(array(
    'key' => 'group_benefits',
    'title' => 'Korzyści',
    'fields' => array(
        array(
            'key' => 'field_benefit_icon',
            'label' => 'Ikona',
            'name' => 'benefit_icon',
            'type' => 'select',
            'instructions' => 'Wybierz ikonę dla korzyści',
            'required' => 1,
            'choices' => array(
                'bot' => 'Bot (Automatyzacja)',
                'trending-up' => 'Trending Up (Bilans)',
                'tags' => 'Tags (Kategoryzacja)',
                'clock' => 'Clock (Czas rzeczywisty)',
                'shield' => 'Shield (Bezpieczeństwo)',
            ),
            'default_value' => 'bot',
        ),
        array(
            'key' => 'field_benefit_highlight',
            'label' => 'Podświetlenie',
            'name' => 'benefit_highlight',
            'type' => 'text',
            'instructions' => 'Krótki tekst podświetlający (np. "Auto-categorize")',
            'maxlength' => 20,
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'benefits',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
));

// Pricing Plans Fields
acf_add_local_field_group(array(
    'key' => 'group_pricing_plans',
    'title' => 'Plany cenowe',
    'fields' => array(
        array(
            'key' => 'field_plan_price',
            'label' => 'Cena',
            'name' => 'plan_price',
            'type' => 'text',
            'instructions' => 'Cena planu (np. "99", "199", "Bezpłatny")',
            'required' => 1,
        ),
        array(
            'key' => 'field_plan_period',
            'label' => 'Okres',
            'name' => 'plan_period',
            'type' => 'text',
            'instructions' => 'Okres rozliczeniowy (np. "/miesiąc", "/rok", "")',
            'default_value' => '/miesiąc',
        ),
        array(
            'key' => 'field_plan_features',
            'label' => 'Funkcjonalności',
            'name' => 'plan_features',
            'type' => 'textarea',
            'instructions' => 'Lista funkcjonalności (jedna na linię)',
            'rows' => 10,
        ),
        array(
            'key' => 'field_plan_cta_text',
            'label' => 'Tekst przycisku',
            'name' => 'plan_cta_text',
            'type' => 'text',
            'instructions' => 'Tekst przycisku CTA',
            'default_value' => 'Rozpocznij',
        ),
        array(
            'key' => 'field_plan_cta_url',
            'label' => 'URL przycisku',
            'name' => 'plan_cta_url',
            'type' => 'url',
            'instructions' => 'Link przycisku CTA',
        ),
        array(
            'key' => 'field_plan_popular',
            'label' => 'Popularny',
            'name' => 'plan_popular',
            'type' => 'true_false',
            'instructions' => 'Czy plan jest oznaczony jako popularny?',
            'default_value' => 0,
            'ui' => 1,
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'pricing_plans',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
));

// Global Settings (for site-wide settings)
acf_add_local_field_group(array(
    'key' => 'group_global_settings',
    'title' => 'Ustawienia globalne',
    'fields' => array(
        array(
            'key' => 'field_site_logo',
            'label' => 'Logo strony',
            'name' => 'site_logo',
            'type' => 'image',
            'instructions' => 'Logo wyświetlane w nawigacji',
            'return_format' => 'url',
        ),
        array(
            'key' => 'field_contact_email',
            'label' => 'Email kontaktowy',
            'name' => 'contact_email',
            'type' => 'email',
            'instructions' => 'Email do kontaktu',
        ),
        array(
            'key' => 'field_contact_phone',
            'label' => 'Telefon kontaktowy',
            'name' => 'contact_phone',
            'type' => 'text',
            'instructions' => 'Numer telefonu do kontaktu',
        ),
        array(
            'key' => 'field_social_links',
            'label' => 'Linki społecznościowe',
            'name' => 'social_links',
            'type' => 'repeater',
            'instructions' => 'Dodaj linki do mediów społecznościowych',
            'min' => 0,
            'max' => 10,
            'layout' => 'table',
            'button_label' => 'Dodaj link',
            'sub_fields' => array(
                array(
                    'key' => 'field_social_name',
                    'label' => 'Nazwa',
                    'name' => 'name',
                    'type' => 'text',
                    'required' => 1,
                ),
                array(
                    'key' => 'field_social_url',
                    'label' => 'URL',
                    'name' => 'url',
                    'type' => 'url',
                    'required' => 1,
                ),
                array(
                    'key' => 'field_social_icon',
                    'label' => 'Ikona',
                    'name' => 'icon',
                    'type' => 'text',
                    'instructions' => 'Nazwa ikony (np. facebook, twitter, linkedin)',
                ),
            ),
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'options_page',
                'operator' => '==',
                'value' => 'theme-general-settings',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
));

// Add options page
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Ustawienia DogInvoice',
        'menu_title' => 'DogInvoice Settings',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'icon_url' => 'dashicons-admin-settings',
    ));
}
?>
