<?php
/**
 * DogInvoice - Setup Default Values
 * Uruchom ten skrypt po aktywacji pluginu, żeby ustawić domyślne wartości
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

function doginvoice_setup_default_values() {
    // Hero Section
    update_option('doginvoice_hero_title', 'Robisz zdjęcie faktury, a reszta dzieje się automatycznie');
    update_option('doginvoice_hero_subtitle', 'DogInvoice - AI Invoice Processing');
    update_option('doginvoice_hero_description', 'DogInvoice automatycznie organizuje Twoje dokumenty, eliminuje chaos administracyjny i pozwala Ci skupić się na tym, co naprawdę ważne.');
    update_option('doginvoice_hero_video_url', '/videos/doginvoice_hero.mp4');
    update_option('doginvoice_hero_video_poster', '/doginvoice_hero_frame.png');
    update_option('doginvoice_hero_cta_primary_text', 'Wybierz swój plan');
    update_option('doginvoice_hero_cta_primary_url', '#pricing');
    update_option('doginvoice_hero_cta_secondary_text', 'Przetestuj za darmo');
    update_option('doginvoice_hero_cta_secondary_url', '/trial');
    
    // Numbers Section
    update_option('doginvoice_numbers_invoices_value', '75000');
    update_option('doginvoice_numbers_invoices_suffix', '+');
    update_option('doginvoice_numbers_invoices_title', 'Przetworzonych faktur');
    update_option('doginvoice_numbers_invoices_description', 'przez naszych klientów');
    update_option('doginvoice_numbers_invoices_color', 'text-primary');
    
    update_option('doginvoice_numbers_hours_value', '25');
    update_option('doginvoice_numbers_hours_suffix', 'h');
    update_option('doginvoice_numbers_hours_title', 'Oszczędności tygodniowo');
    update_option('doginvoice_numbers_hours_description', 'średnio na każdego użytkownika');
    update_option('doginvoice_numbers_hours_color', 'text-orange-500');
    
    update_option('doginvoice_numbers_accuracy_value', '99');
    update_option('doginvoice_numbers_accuracy_suffix', '%');
    update_option('doginvoice_numbers_accuracy_title', 'Dokładność AI');
    update_option('doginvoice_numbers_accuracy_description', 'w rozpoznawaniu danych z faktur');
    update_option('doginvoice_numbers_accuracy_color', 'text-primary');
    
    // Features Section
    update_option('doginvoice_features_1_title', 'Automatyczne rozpoznawanie');
    update_option('doginvoice_features_1_description', 'AI automatycznie wyodrębnia wszystkie kluczowe dane z faktur');
    update_option('doginvoice_features_1_icon', 'brain');
    update_option('doginvoice_features_1_highlight', '99% dokładności');
    
    update_option('doginvoice_features_2_title', 'Inteligentna kategoryzacja');
    update_option('doginvoice_features_2_description', 'System automatycznie kategoryzuje wydatki zgodnie z planem kont');
    update_option('doginvoice_features_2_icon', 'tags');
    update_option('doginvoice_features_2_highlight', 'Automatyczna klasyfikacja');
    
    update_option('doginvoice_features_3_title', 'Bezpieczne archiwum');
    update_option('doginvoice_features_3_description', 'Wszystkie dokumenty są bezpiecznie przechowywane w chmurze');
    update_option('doginvoice_features_3_icon', 'shield');
    update_option('doginvoice_features_3_highlight', '100% bezpieczeństwa');
    
    // Pricing Section
    update_option('doginvoice_pricing_1_name', 'Starter');
    update_option('doginvoice_pricing_1_price', '49');
    update_option('doginvoice_pricing_1_period', 'miesięcznie');
    update_option('doginvoice_pricing_1_description', 'Idealne dla małych firm');
    update_option('doginvoice_pricing_1_features', 'Do 100 faktur miesięcznie|Podstawowe raportowanie|Email support');
    update_option('doginvoice_pricing_1_cta_text', 'Wybierz plan');
    update_option('doginvoice_pricing_1_cta_url', '/pricing/starter');
    update_option('doginvoice_pricing_1_popular', false);
    
    update_option('doginvoice_pricing_2_name', 'Professional');
    update_option('doginvoice_pricing_2_price', '149');
    update_option('doginvoice_pricing_2_period', 'miesięcznie');
    update_option('doginvoice_pricing_2_description', 'Dla rozwijających się biznesów');
    update_option('doginvoice_pricing_2_features', 'Do 500 faktur miesięcznie|Zaawansowane raporty|Priority support|Integracje API');
    update_option('doginvoice_pricing_2_cta_text', 'Wybierz plan');
    update_option('doginvoice_pricing_2_cta_url', '/pricing/professional');
    update_option('doginvoice_pricing_2_popular', true);
    
    update_option('doginvoice_pricing_3_name', 'Enterprise');
    update_option('doginvoice_pricing_3_price', '399');
    update_option('doginvoice_pricing_3_period', 'miesięcznie');
    update_option('doginvoice_pricing_3_description', 'Dla dużych organizacji');
    update_option('doginvoice_pricing_3_features', 'Nieograniczone faktury|Dedykowany account manager|24/7 support|Custom integracje');
    update_option('doginvoice_pricing_3_cta_text', 'Skontaktuj się');
    update_option('doginvoice_pricing_3_cta_url', '/contact');
    update_option('doginvoice_pricing_3_popular', false);
    
    echo '<div class="notice notice-success"><p>✅ Domyślne wartości zostały ustawione!</p></div>';
    echo '<p><a href="' . admin_url('options-general.php?page=doginvoice-settings') . '" class="button button-primary">Przejdź do ustawień DogInvoice</a></p>';
    echo '<p><a href="http://localhost:8080/wp-json/doginvoice/v1/hero" target="_blank" class="button">Test API Hero</a></p>';
    echo '<p><a href="http://localhost:8080/wp-json/doginvoice/v1/numbers" target="_blank" class="button">Test API Numbers</a></p>';
}

// Check if we should setup default values
if (isset($_GET['setup_defaults']) && $_GET['setup_defaults'] === 'true') {
    doginvoice_setup_default_values();
} else {
    echo '<h1>DogInvoice - Setup Default Values</h1>';
    echo '<p>Kliknij poniżej, żeby ustawić domyślne wartości dla DogInvoice API:</p>';
    echo '<p><a href="?setup_defaults=true" class="button button-primary">Ustaw domyślne wartości</a></p>';
}
?>