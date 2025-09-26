<?php
/**
 * Plugin Name: DogInvoice API
 * Description: API endpoints for DogInvoice headless WordPress setup
 * Version: 1.0.0
 * Author: DogInvoice Team
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

class DogInvoiceAPI {
    
    public function __construct() {
        add_action('rest_api_init', array($this, 'register_api_routes'));
        add_action('init', array($this, 'create_custom_fields'));
    }
    
    public function register_api_routes() {
        // Hero endpoint
        register_rest_route('doginvoice/v1', '/hero', array(
            'methods' => 'GET',
            'callback' => array($this, 'get_hero_data'),
            'permission_callback' => '__return_true',
        ));
        
        // Numbers endpoint
        register_rest_route('doginvoice/v1', '/numbers', array(
            'methods' => 'GET',
            'callback' => array($this, 'get_numbers_data'),
            'permission_callback' => '__return_true',
        ));
        
        // Features endpoint
        register_rest_route('doginvoice/v1', '/features', array(
            'methods' => 'GET',
            'callback' => array($this, 'get_features_data'),
            'permission_callback' => '__return_true',
        ));
        
        // Pricing endpoint
        register_rest_route('doginvoice/v1', '/pricing', array(
            'methods' => 'GET',
            'callback' => array($this, 'get_pricing_data'),
            'permission_callback' => '__return_true',
        ));
        
        // Benefits endpoint
        register_rest_route('doginvoice/v1', '/benefits', array(
            'methods' => 'GET',
            'callback' => array($this, 'get_benefits_data'),
            'permission_callback' => '__return_true',
        ));
        
        // Process endpoint
        register_rest_route('doginvoice/v1', '/process', array(
            'methods' => 'GET',
            'callback' => array($this, 'get_process_data'),
            'permission_callback' => '__return_true',
        ));
        
        // Integrations endpoint
        register_rest_route('doginvoice/v1', '/integrations', array(
            'methods' => 'GET',
            'callback' => array($this, 'get_integrations_data'),
            'permission_callback' => '__return_true',
        ));
        
        // FAQ endpoint
        register_rest_route('doginvoice/v1', '/faq', array(
            'methods' => 'GET',
            'callback' => array($this, 'get_faq_data'),
            'permission_callback' => '__return_true',
        ));
        
        // CTA endpoint
        register_rest_route('doginvoice/v1', '/cta', array(
            'methods' => 'GET',
            'callback' => array($this, 'get_cta_data'),
            'permission_callback' => '__return_true',
        ));
        
        // Trusted By endpoint
        register_rest_route('doginvoice/v1', '/trusted-by', array(
            'methods' => 'GET',
            'callback' => array($this, 'get_trusted_by_data'),
            'permission_callback' => '__return_true',
        ));
        
        // Form Page endpoint
        register_rest_route('doginvoice/v1', '/form', array(
            'methods' => 'GET',
            'callback' => array($this, 'get_form_data'),
            'permission_callback' => '__return_true',
        ));
        
        // Privacy Policy endpoint
        register_rest_route('doginvoice/v1', '/privacy', array(
            'methods' => 'GET',
            'callback' => array($this, 'get_privacy_data'),
            'permission_callback' => '__return_true',
        ));
        
        // Terms of Service endpoint
        register_rest_route('doginvoice/v1', '/terms', array(
            'methods' => 'GET',
            'callback' => array($this, 'get_terms_data'),
            'permission_callback' => '__return_true',
        ));
    }
    
    public function get_hero_data($request) {
        // Get hero data from our unified admin system
        $content = get_option('doginvoice_content', array());
        if (is_string($content)) {
            $content = maybe_unserialize($content);
        }
        
        $hero_data = array(
            'id' => 1,
            'title' => $content['hero_title'] ?? 'Robisz zdjęcie faktury, a reszta dzieje się automatycznie',
            'subtitle' => 'DogInvoice - AI Invoice Processing', // Fixed subtitle
            'description' => $content['hero_description'] ?? 'DogInvoice automatycznie organizuje Twoje dokumenty, eliminuje chaos administracyjny i pozwala Ci skupić się na tym, co naprawdę ważne.',
            'video_url' => $content['hero_video_url'] ?? '/videos/doginvoice_hero.mp4',
            'video_poster' => $content['hero_video_poster_url'] ?? '/doginvoice_hero_frame.png',
            'cta_primary_text' => $content['hero_cta_primary_text'] ?? 'Wybierz swój plan',
            'cta_primary_url' => $content['hero_cta_primary_url'] ?? '#pricing',
            'cta_secondary_text' => $content['hero_cta_secondary_text'] ?? 'Przetestuj za darmo',
            'cta_secondary_url' => $content['hero_cta_secondary_url'] ?? '/trial',
        );
        
        return rest_ensure_response($hero_data);
    }
    
    public function get_numbers_data($request) {
        // Get numbers data from our unified admin system
        $content = get_option('doginvoice_content', array());
        if (is_string($content)) {
            $content = maybe_unserialize($content);
        }
        
        $numbers = $content['animated_numbers'] ?? array();
        $formatted_numbers = array();
        foreach ($numbers as $index => $number) {
            if (!empty($number['title'])) {
                $formatted_numbers[] = array(
                    'value' => intval($number['value'] ?? 0),
                    'suffix' => $number['suffix'] ?? '+',
                    'title' => $number['title'],
                    'description' => $number['description'] ?? '',
                    'color' => $number['color'] ?? 'text-primary'
                );
            }
        }

        // If no numbers from ACF, provide fallback
        if (empty($formatted_numbers)) {
            $formatted_numbers = array(
                array(
                    'value' => 70000,
                    'suffix' => '+',
                    'title' => 'Przetworzonych faktur',
                    'description' => 'przez naszych klientów',
                    'color' => 'text-primary'
                ),
                array(
                    'value' => 20,
                    'suffix' => 'h',
                    'title' => 'Oszczędności tygodniowo',
                    'description' => 'średnio na każdego użytkownika',
                    'color' => 'text-orange-500'
                ),
                array(
                    'value' => 99,
                    'suffix' => '%',
                    'title' => 'Dokładność AI',
                    'description' => 'w rozpoznawaniu danych z faktur',
                    'color' => 'text-primary'
                )
            );
        }
        
        return rest_ensure_response($formatted_numbers);
    }
    
    public function get_features_data($request) {
        // Get features from our unified admin system
        $content = get_option('doginvoice_content', array());
        if (is_string($content)) {
            $content = maybe_unserialize($content);
        }
        
        $features_title = $content['features_title'] ?? 'Funkcjonalności automatyzujące pracę księgowości';
        $features_description = $content['features_description'] ?? 'Poznaj główne zalety naszego systemu.';
        
        $features = $content['features'] ?? array();
        $formatted_features = array();
        
        foreach ($features as $index => $feature) {
            if (!empty($feature['feature_title'])) {
                $formatted_features[] = array(
                    'id' => $index + 1,
                    'title' => $feature['feature_title'],
                    'description' => $feature['feature_description'] ?? '',
                    'icon' => $feature['feature_icon'] ?? 'zap',
                    'video_url' => $feature['feature_video_url'] ?? '',
                    'poster_url' => $feature['feature_poster_url'] ?? '',
                    'highlight' => '' // Features nie ma highlight w ACF
                );
            }
        }

        // If no features from ACF, provide fallback
        if (empty($formatted_features)) {
            $formatted_features = array(
                array(
                    'id' => 1,
                    'title' => 'Automatyzacja i integracja z AI',
                    'description' => 'Faktury przychodzące mailem lub przez dedykowany portal są automatycznie przetwarzane przez algorytm AI, który między innymi wykrywa kategorię wydatku.',
                    'icon' => 'zap',
                    'video_url' => '/videos/aiautomation.mp4',
                    'poster_url' => '/cover_1.png',
                    'highlight' => ''
                ),
                array(
                    'id' => 2,
                    'title' => 'Obsługa trudnych przypadków',
                    'description' => 'Jeśli zdjęcie faktury jest nieczytelne lub niewyraźne, automatycznie korzystamy z autorskiej technologii AI OCR, aby zapewnić poprawne odczytanie wszystkich informacji.',
                    'icon' => 'trending-up',
                    'video_url' => '/videos/realtime.mp4',
                    'poster_url' => '/cover_2.png',
                    'highlight' => ''
                ),
                array(
                    'id' => 3,
                    'title' => 'Analiza finansowa',
                    'description' => 'Na bieżąco monitoruj koszty i przychody dzięki intuicyjnym zestawieniom i wykresom. Komplet dokumentów można później łatwo wysłać do księgowej.',
                    'icon' => 'settings',
                    'video_url' => '/videos/integration.mp4',
                    'poster_url' => '/cover_3.png',
                    'highlight' => ''
                )
            );
        }
        
        return rest_ensure_response(array(
            'title' => $features_title,
            'description' => $features_description,
            'items' => $formatted_features
        ));
    }
    
    public function get_pricing_data($request) {
        // Get data from WordPress options (editable w panelu WordPress)
        $content = get_option('doginvoice_content', array());
        
        // Parse the serialized data if it's a string
        if (is_string($content)) {
            $content = maybe_unserialize($content);
        }
        
        // Extract pricing data
        $pricing_title = $content['pricing_title'] ?? 'Prosty cennik';
        $pricing_description = $content['pricing_description'] ?? 'Wybierz plan idealny dla Twojej firmy.';
        $pricing_footer_text = $content['pricing_footer_text'] ?? 'Podane ceny są cenami netto. Potrzebujesz więcej informacji? Skontaktuj się z nami';
        $pricing_footer_button_text = $content['pricing_footer_button_text'] ?? 'Skontaktuj się z nami';
        $pricing_footer_button_url = $content['pricing_footer_button_url'] ?? '#contact';
        
        // Switch settings
        $switch_monthly_label = $content['pricing_switch_monthly_label'] ?? 'Miesięcznie';
        $switch_yearly_label = $content['pricing_switch_yearly_label'] ?? 'Rocznie';
        $yearly_discount_percent = $content['pricing_yearly_discount_percent'] ?? 50;
        
        // Get pricing plans from ACF posts
        $plans = $this->get_pricing_plans();
        
        // Return complete pricing data structure
        return rest_ensure_response(array(
            'title' => $pricing_title,
            'description' => $pricing_description,
            'footer_text' => $pricing_footer_text,
            'footer_button_text' => $pricing_footer_button_text,
            'footer_button_url' => $pricing_footer_button_url,
            'switch_monthly_label' => $switch_monthly_label,
            'switch_yearly_label' => $switch_yearly_label,
            'yearly_discount_percent' => $yearly_discount_percent,
            'plans' => $plans
        ));
    }
    
    private function get_pricing_plans() {
        // Get data from WordPress options (editable w panelu WordPress)
        $content = get_option('doginvoice_content', array());
        
        // Parse the serialized data if it's a string
        if (is_string($content)) {
            $content = maybe_unserialize($content);
        }
        
        // Get pricing plans from ACF data
        $acf_plans = $content['pricing_plans'] ?? array();
        
        $formatted_plans = array();
        foreach ($acf_plans as $index => $plan) {
            $formatted_plans[] = array(
                'id' => $index + 1,
                'name' => $plan['plan_name'] ?? '',
                'plan_id' => $plan['plan_id'] ?? sanitize_title($plan['plan_name'] ?? ''),
                'description' => $plan['plan_description'] ?? '',
                'invoices' => $plan['plan_invoices'] ?? '',
                'monthly_price' => intval($plan['plan_monthly_price'] ?? 0),
                'available_monthly' => $plan['plan_available_monthly'] ?? true,
                'available_yearly' => $plan['plan_available_yearly'] ?? true,
                'button_text' => $plan['plan_button_text'] ?? 'Wybierz plan',
                'button_url' => $plan['plan_button_url'] ?? '',
                'is_popular' => $plan['plan_is_popular'] ?? false,
                'is_custom_pricing' => $plan['plan_is_custom_pricing'] ?? false
            );
        }

        // If no plans from ACF, provide fallback
        if (empty($formatted_plans)) {
            $formatted_plans = array(
                array(
                    'id' => 1,
                    'name' => 'Starter',
                    'plan_id' => 'starter',
                    'description' => 'Na dobry początek.',
                    'invoices' => '10 faktur miesięcznie.',
                    'monthly_price' => 0,
                    'available_monthly' => true,
                    'available_yearly' => false,
                    'button_text' => 'Rozpocznij za darmo',
                    'button_url' => '/trial?plan=starter&billing=monthly',
                    'is_popular' => false,
                    'is_custom_pricing' => false
                ),
                array(
                    'id' => 2,
                    'name' => 'Professional',
                    'plan_id' => 'professional',
                    'description' => 'Dla rozwijających się firm.',
                    'invoices' => '150 faktur miesięcznie.',
                    'monthly_price' => 149,
                    'available_monthly' => true,
                    'available_yearly' => true,
                    'button_text' => 'Wybierz plan',
                    'button_url' => '/trial?plan=professional&billing=monthly',
                    'is_popular' => true,
                    'is_custom_pricing' => false
                ),
                array(
                    'id' => 3,
                    'name' => 'Business',
                    'plan_id' => 'business',
                    'description' => 'Dla dużych organizacji.',
                    'invoices' => '500 faktur miesięcznie.',
                    'monthly_price' => 299,
                    'available_monthly' => true,
                    'available_yearly' => true,
                    'button_text' => 'Wybierz plan',
                    'button_url' => '/trial?plan=business&billing=monthly',
                    'is_popular' => false,
                    'is_custom_pricing' => false
                ),
                array(
                    'id' => 4,
                    'name' => 'Enterprise',
                    'plan_id' => 'enterprise',
                    'description' => 'Dla tych, którzy potrzebują więcej',
                    'invoices' => 'Niestandardowe rozwiązania.',
                    'monthly_price' => 0,
                    'available_monthly' => true,
                    'available_yearly' => true,
                    'button_text' => 'Skontaktuj się',
                    'button_url' => '/trial?plan=enterprise&billing=monthly',
                    'is_popular' => false,
                    'is_custom_pricing' => false
                )
            );
        }

        return $formatted_plans;
    }
    
    // Placeholder methods for other endpoints
    public function get_benefits_data($request) {
        // Get benefits from our unified admin system
        $content = get_option('doginvoice_content', array());
        if (is_string($content)) {
            $content = maybe_unserialize($content);
        }
        
        $benefits_title = $content['benefits_title'] ?? 'Zmień sposób zarządzania finansami';
        $benefits_description = $content['benefits_description'] ?? 'Poznaj trzy fundamenty, które poprawią wydajność pracy księgowej.';
        
        $benefits = $content['benefits'] ?? array();
        $formatted_benefits = array();
        foreach ($benefits as $index => $benefit) {
            if (!empty($benefit['benefit_title'])) {
                $formatted_benefits[] = array(
                    'id' => $index + 1,
                    'title' => $benefit['benefit_title'],
                    'description' => $benefit['benefit_description'] ?? '',
                    'highlight' => $benefit['benefit_highlight'] ?? '',
                    'icon' => $benefit['benefit_icon'] ?? 'bot'
                );
            }
        }

        // If no benefits from ACF, provide fallback
        if (empty($formatted_benefits)) {
            $formatted_benefits = array(
                array(
                    'id' => 1,
                    'title' => 'Pełna automatyzacja',
                    'description' => 'Faktury przychodzące mailem lub przez formularz są automatycznie przetwarzane przez specjalny algorytm AI.',
                    'highlight' => 'AI-powered',
                    'icon' => 'bot'
                ),
                array(
                    'id' => 2,
                    'title' => 'Analiza finansowa',
                    'description' => 'Na bieżąco monitoruj koszty i przychody dzięki intuicyjnym zestawieniom i wykresom.',
                    'highlight' => 'Real-time',
                    'icon' => 'bar-chart-3'
                ),
                array(
                    'id' => 3,
                    'title' => 'Inteligentne rozliczenia',
                    'description' => 'System automatycznie kategoryzuje wydatki zgodnie z planem kont i przepisami podatkowymi.',
                    'highlight' => 'Smart OCR',
                    'icon' => 'banknote'
                ),
                array(
                    'id' => 4,
                    'title' => 'Bezpieczne archiwum',
                    'description' => 'Wszystkie dokumenty są bezpiecznie przechowywane w chmurze z możliwością łatwego dostępu.',
                    'highlight' => 'Cloud-based',
                    'icon' => 'folder-open'
                ),
                array(
                    'id' => 5,
                    'title' => 'Wzrost wydajności',
                    'description' => 'Oszczędzaj czas i eliminuj błędy dzięki automatyzacji procesów księgowych.',
                    'highlight' => 'Efficient',
                    'icon' => 'trending-up'
                ),
                array(
                    'id' => 6,
                    'title' => 'Kategoryzacja AI',
                    'description' => 'Zaawansowany algorytm automatycznie przypisuje odpowiednie kategorie do każdej transakcji.',
                    'highlight' => 'Auto-tagging',
                    'icon' => 'tags'
                ),
                array(
                    'id' => 7,
                    'title' => 'Czas rzeczywisty',
                    'description' => 'Wszystkie dane są aktualizowane na bieżąco, zapewniając aktualny obraz finansów firmy.',
                    'highlight' => 'Live updates',
                    'icon' => 'clock'
                )
            );
        }

        return rest_ensure_response(array(
            'title' => $benefits_title,
            'description' => $benefits_description,
            'items' => $formatted_benefits
        ));
    }
    
    public function get_process_data($request) {
        // Get data from WordPress options (where ACF stores data)
        $content = get_option('doginvoice_content', array());
        
        // Parse the serialized data if it's a string
        if (is_string($content)) {
            $content = maybe_unserialize($content);
        }
        
        // Extract process data
        $process_title = $content['process_title'] ?? 'Jak to działa?';
        $process_description = $content['process_description'] ?? 'Prosty, zautomatyzowany proces w 5 krokach';
        $process_steps = $content['process_steps'] ?? array();
        
        // Map ACF repeater data to API format
        $steps = array();
        if (is_array($process_steps)) {
            foreach ($process_steps as $index => $step) {
                $steps[] = array(
                    'id' => $index + 1,
                    'step_number' => $step['step_number'] ?? ($index + 1),
                    'title' => $step['step_title'] ?? "Krok " . ($index + 1),
                    'description' => $step['step_description'] ?? "Opis kroku " . ($index + 1),
                    'step_video_url' => $step['step_video_url'] ?? '',
                    'step_thumbnail_url' => $step['step_thumbnail_url'] ?? ''
                );
            }
        }
        
        // Check if ACF data is empty or corrupted, use fallback
        if (empty($steps)) {
            $steps = array(
                array(
                    'id' => 1,
                    'step_number' => 1,
                    'title' => 'Wyślij fakturę',
                    'description' => 'Prześlij fakturę mailem lub przez formularz na stronie',
                    'step_video_url' => '/videos/send_instruction.mp4',
                    'step_thumbnail_url' => '/steps/step01.png'
                ),
                array(
                    'id' => 2,
                    'step_number' => 2,
                    'title' => 'Weryfikacja GUS',
                    'description' => 'System automatycznie weryfikuje dane w bazie GUS',
                    'step_video_url' => '/videos/gus.mp4',
                    'step_thumbnail_url' => '/steps/step02.png'
                ),
                array(
                    'id' => 3,
                    'step_number' => 3,
                    'title' => 'Automatyzacja AI',
                    'description' => 'Algorytm AI przetwarza i kategoryzuje fakturę',
                    'step_video_url' => '/videos/automation.mp4',
                    'step_thumbnail_url' => '/steps/step03.png'
                ),
                array(
                    'id' => 4,
                    'step_number' => 4,
                    'title' => 'Archiwizacja',
                    'description' => 'Faktura jest zapisywana na Twoim Dysku Google',
                    'step_video_url' => '/videos/google_drive.mp4',
                    'step_thumbnail_url' => '/steps/step04.png'
                ),
                array(
                    'id' => 5,
                    'step_number' => 5,
                    'title' => 'Analiza',
                    'description' => 'Dane są dodawane do dashboardu w czasie rzeczywistym',
                    'step_video_url' => '/videos/analytics.mp4',
                    'step_thumbnail_url' => '/steps/step05.png'
                )
            );
        }
        
        return rest_ensure_response(array(
            'title' => $process_title,
            'description' => $process_description,
            'steps' => $steps
        ));
    }
    
    public function get_integrations_data($request) {
        // Get integrations from our unified admin system
        $content = get_option('doginvoice_content', array());
        $integrations = $content['integrations'] ?? array();
        
        $formatted_integrations = array();
        foreach ($integrations as $index => $integration) {
            if (!empty($integration['integration_name'])) {
                // Mapowanie URL logo na logo_key
                $logo_url = $integration['integration_logo'] ?? '';
                $logo_key = '';
                
                if (!empty($logo_url)) {
                    // Mapowanie URL na logo_key na podstawie nazwy pliku
                    if (strpos($logo_url, 'smtp_imap_icon') !== false) {
                        $logo_key = 'smtp_imap_icon';
                    } elseif (strpos($logo_url, 'logo_gmail') !== false) {
                        $logo_key = 'logo_gmail';
                    } elseif (strpos($logo_url, 'google_drive_logo') !== false) {
                        $logo_key = 'google_drive_logo';
                    } elseif (strpos($logo_url, 'gus_logo') !== false) {
                        $logo_key = 'gus_logo';
                    } elseif (strpos($logo_url, 'optima_logo') !== false) {
                        $logo_key = 'optima_logo';
                    } elseif (strpos($logo_url, 'fakturownia_logo') !== false) {
                        $logo_key = 'fakturownia_logo';
                    } elseif (strpos($logo_url, 'saldeo_logo') !== false) {
                        $logo_key = 'saldeo_logo';
                    } elseif (strpos($logo_url, 'ksef_logo') !== false) {
                        $logo_key = 'ksef_logo';
                    }
                }
                
                $formatted_integrations[] = array(
                    'id' => $index + 1,
                    'title' => $integration['integration_name'],
                    'logo_key' => $logo_key,
                    'height' => $integration['integration_height'] ?? 35,
                    'coming_soon' => $integration['integration_coming_soon'] ?? false
                );
            }
        }

        // If no integrations from ACF, provide fallback
        if (empty($formatted_integrations)) {
            $formatted_integrations = array(
                array(
                    'id' => 1,
                    'title' => 'SMTP/IMAP',
                    'logo_key' => 'smtp_imap_icon',
                    'coming_soon' => false,
                    'description' => 'Integracja z serwerami pocztowymi'
                ),
                array(
                    'id' => 2,
                    'title' => 'Gmail',
                    'logo_key' => 'logo_gmail',
                    'coming_soon' => false,
                    'description' => 'Integracja z kontem Gmail'
                ),
                array(
                    'id' => 3,
                    'title' => 'Google Drive',
                    'logo_key' => 'google_drive_logo',
                    'coming_soon' => false,
                    'description' => 'Integracja z Dyskiem Google'
                ),
                array(
                    'id' => 4,
                    'title' => 'GUS',
                    'logo_key' => 'gus_logo',
                    'coming_soon' => false,
                    'description' => 'Weryfikacja w bazie GUS'
                ),
                array(
                    'id' => 5,
                    'title' => 'Comarch Optima',
                    'logo_key' => 'optima_logo',
                    'coming_soon' => false,
                    'description' => 'Integracja z systemem księgowym'
                ),
                array(
                    'id' => 6,
                    'title' => 'Fakturownia',
                    'logo_key' => 'fakturownia_logo',
                    'coming_soon' => false,
                    'description' => 'Integracja z systemem faktur'
                ),
                array(
                    'id' => 7,
                    'title' => 'Saldeo',
                    'logo_key' => 'saldeo_logo',
                    'coming_soon' => true,
                    'description' => 'Integracja z systemem księgowym'
                ),
                array(
                    'id' => 8,
                    'title' => 'KSeF',
                    'logo_key' => 'ksef_logo',
                    'coming_soon' => true,
                    'description' => 'Integracja z Krajowym Systemem e-Faktur'
                )
            );
        }

        return rest_ensure_response(array(
            'title' => $content['integrations_title'] ?? 'Gotowe integracje',
            'description' => $content['integrations_description'] ?? 'Połącz DogInvoice z oprogramowaniem, z którego korzystasz na codzień.',
            'more_text' => $content['integrations_more_text'] ?? 'Szukasz wsparcia dla konkretnego systemu? Daj nam znać. Wkrótce więcej integracji',
            'more_link' => $content['integrations_more_link'] ?? '#',
            'integrations' => $formatted_integrations
        ));
    }
    
    public function get_faq_data($request) {
        // Get data from WordPress options (ACF)
        $content = get_option('doginvoice_content', array());
        
        // Parse the serialized data if it's a string
        if (is_string($content)) {
            $content = maybe_unserialize($content);
        }
        
        // Extract FAQ data from ACF
        $faq_title = $content['faq_title'] ?? 'Często zadawane pytania';
        $faq_description = $content['faq_description'] ?? 'Odpowiedzi na najważniejsze wątpliwości.';
        
        $faqs = $content['faq'] ?? array(
            array(
                'faq_question' => 'Jak zabezpieczane są moje dane finansowe?',
                'faq_answer' => 'DogInvoice działa w oparciu o najwyższe standardy bezpieczeństwa. Twoje dane są szyfrowane i przechowywane zgodnie z regulacjami RODO. Używamy tylko zaufanych dostawców chmury i regularnie przeprowadzamy audyty bezpieczeństwa.'
            ),
            array(
                'faq_question' => 'Czy system można połączyć z moim oprogramowaniem księgowym?',
                'faq_answer' => 'Tak, DogInvoice oferuje integracje z popularnymi systemami księgowymi. Możemy również stworzyć dedykowaną integrację dla Twojego systemu.'
            ),
            array(
                'faq_question' => 'Ile trwa wdrożenie systemu?',
                'faq_answer' => 'Standardowe wdrożenie trwa 2-3 dni robocze, włączając szkolenie pracowników. W przypadku bardziej złożonych konfiguracji może to potrwać do 5 dni.'
            ),
            array(
                'faq_question' => 'Czy mogę dostosować system do nietypowych potrzeb?',
                'faq_answer' => 'Oferujemy personalizację kategorii kosztów, przepływu pracy i raportów, aby idealnie dopasować system do Twojej działalności.'
            ),
            array(
                'faq_question' => 'Czy system obsługuje faktury w różnych językach?',
                'faq_answer' => 'Tak, DogInvoice obsługuje faktury w większości języków.'
            )
        );
        $formatted_faqs = array();
        
        foreach ($faqs as $index => $faq) {
            if (!empty($faq['faq_question'])) {
                $formatted_faqs[] = array(
                    'id' => $index + 1,
                    'question' => $faq['faq_question'],
                    'answer' => $faq['faq_answer'] ?? ''
                );
            }
        }

        // If no FAQs from ACF, provide fallback
        if (empty($formatted_faqs)) {
            $formatted_faqs = array(
                array(
                    'id' => 1,
                    'question' => 'Jak zabezpieczane są moje dane finansowe?',
                    'answer' => 'DogInvoice działa w oparciu o najwyższe standardy bezpieczeństwa. Twoje dane są szyfrowane i przechowywane zgodnie z regulacjami RODO. Używamy tylko zaufanych dostawców chmury i regularnie przeprowadzamy audyty bezpieczeństwa.'
                ),
                array(
                    'id' => 2,
                    'question' => 'Czy system można połączyć z moim oprogramowaniem księgowym?',
                    'answer' => 'Tak, DogInvoice oferuje integracje z popularnymi systemami księgowymi. Możemy również stworzyć dedykowaną integrację dla Twojego systemu.'
                ),
                array(
                    'id' => 3,
                    'question' => 'Ile trwa wdrożenie systemu?',
                    'answer' => 'Standardowe wdrożenie trwa 2-3 dni robocze, włączając szkolenie pracowników. W przypadku bardziej złożonych konfiguracji może to potrwać do 5 dni.'
                ),
                array(
                    'id' => 4,
                    'question' => 'Czy mogę dostosować system do nietypowych potrzeb?',
                    'answer' => 'Oferujemy personalizację kategorii kosztów, przepływu pracy i raportów, aby idealnie dopasować system do Twojej działalności.'
                ),
                array(
                    'id' => 5,
                    'question' => 'Czy system obsługuje faktury w różnych językach?',
                    'answer' => 'Tak, DogInvoice obsługuje faktury w większości języków.'
                )
            );
        }

        return rest_ensure_response(array(
            'title' => $faq_title,
            'description' => $faq_description,
            'faqs' => $formatted_faqs
        ));
    }
    
    public function get_cta_data($request) {
        // Get data from WordPress options
        $content = get_option('doginvoice_content', array());
        
        // Parse the serialized data if it's a string
        if (is_string($content)) {
            $content = maybe_unserialize($content);
        }
        
        // Extract CTA data
        $cta_title = $content['cta_title'] ?? 'Zacznij już dziś';
        $cta_subtitle = $content['cta_subtitle'] ?? 'Dołącz do firm, które oszczędzają 15 godzin tygodniowo dzięki automatyzacji.';
        $cta_primary_text = $content['cta_button_primary_text'] ?? 'Wybierz swój plan';
        $cta_primary_url = $content['cta_button_primary_url'] ?? '#pricing';
        $cta_secondary_text = $content['cta_button_secondary_text'] ?? 'Przetestuj za darmo';
        $cta_secondary_url = $content['cta_button_secondary_url'] ?? '/trial';
        
        return rest_ensure_response(array(
            'title' => $cta_title,
            'subtitle' => $cta_subtitle,
            'button_primary_text' => $cta_primary_text,
            'button_primary_url' => $cta_primary_url,
            'button_secondary_text' => $cta_secondary_text,
            'button_secondary_url' => $cta_secondary_url
        ));
    }
    
    public function get_trusted_by_data($request) {
        // Get data from WordPress options
        $content = get_option('doginvoice_content', array());
        
        // Parse the serialized data if it's a string
        if (is_string($content)) {
            $content = maybe_unserialize($content);
        }
        
        // Extract trusted by data
        $trusted_by_title = $content['trusted_by']['trusted_by_title'] ?? 'Z DogInvoice już korzystają';
        $trusted_by_logos = $content['trusted_by']['trusted_by_logos'] ?? array();
        
        
        // Format logos from ACF
        $formatted_logos = array();
        if (!empty($trusted_by_logos)) {
            foreach ($trusted_by_logos as $logo) {
                // Handle different CSS height formats
                $height = $logo['logo_height'] ?? '16px';
                
                // Convert Tailwind classes to CSS values
                if (strpos($height, 'h-[') === 0) {
                    // Extract value from h-[30px] or h-[2rem] format
                    preg_match('/h-\[([^\]]+)\]/', $height, $matches);
                    $height = isset($matches[1]) ? $matches[1] : '16px';
                } elseif (strpos($height, 'h-') === 0) {
                    // Convert Tailwind classes like h-8, h-12 to pixels
                    $tailwind_map = [
                        'h-1' => '4px', 'h-2' => '8px', 'h-3' => '12px', 'h-4' => '16px',
                        'h-5' => '20px', 'h-6' => '24px', 'h-8' => '32px', 'h-10' => '40px',
                        'h-12' => '48px', 'h-16' => '64px', 'h-20' => '80px', 'h-24' => '96px'
                    ];
                    $height = $tailwind_map[$height] ?? '16px';
                }
                
                // If no unit specified, assume pixels
                if (is_numeric($height)) {
                    $height = $height . 'px';
                }
                
                $formatted_logos[] = array(
                    'name' => $logo['logo_name'] ?? '',
                    'url' => $logo['logo_url'] ?? '',
                    'logo_path' => $logo['logo_path'] ?? '',
                    'logo_height' => $height
                );
            }
        }
        
            // If no logos from ACF, provide fallback
            if (empty($formatted_logos)) {
                $formatted_logos = array(
                    array(
                        'name' => 'Dogtronic',
                        'url' => 'https://dogtronic.io/',
                        'logo_path' => '/assets/dog_logo.svg',
                        'logo_height' => '16px'
                    ),
                    array(
                        'name' => 'Kryptobot',
                        'url' => 'https://kryptobot.net/',
                        'logo_path' => '/assets/kryptobot_logo.svg',
                        'logo_height' => '16px'
                    ),
                    array(
                        'name' => 'Estacluster',
                        'url' => 'https://estacluster.com/',
                        'logo_path' => '/assets/esta_logo.svg',
                        'logo_height' => '16px'
                    ),
                    array(
                        'name' => 'Doza',
                        'url' => 'https://doza.life/',
                        'logo_path' => '/assets/doza_logo.svg',
                        'logo_height' => '16px'
                    )
                );
            }
        
        return rest_ensure_response(array(
            'title' => $trusted_by_title,
            'logos' => $formatted_logos
        ));
    }
    
    public function get_form_data($request) {
        // Get form page data from our unified admin system
        $content = get_option('doginvoice_content', array());
        
        // Parse the serialized data if it's a string
        if (is_string($content)) {
            $content = maybe_unserialize($content);
        }
        
        // Extract form data
        $form_title = $content['form_title'] ?? 'Wybierz swój plan i rozpocznij test';
        $form_description = $content['form_description'] ?? 'Wypełnij formularz, a nasz konsultant skontaktuje się z Tobą w celu finalizacji transakcji.';
        $form_webhook_url = $content['form_webhook_url'] ?? '';
        $form_industries = $content['form_industries'] ?? array();
        
        
        return rest_ensure_response(array(
            'title' => $form_title,
            'description' => $form_description,
            'webhook_url' => $form_webhook_url,
            'industries' => $form_industries
        ));
    }
    
    public function get_privacy_data($request) {
        // Get privacy policy data from our unified admin system
        $content = get_option('doginvoice_content', array());
        
        // Parse the serialized data if it's a string
        if (is_string($content)) {
            $content = maybe_unserialize($content);
        }
        
        // Extract privacy data
        $privacy_title = $content['privacy_title'] ?? 'Polityka prywatności i cookies';
        $privacy_content = $content['privacy_content'] ?? '';
        $privacy_last_updated = $content['privacy_last_updated'] ?? date('Y-m-d');
        
        
        return rest_ensure_response(array(
            'title' => $privacy_title,
            'content' => $privacy_content,
            'last_updated' => $privacy_last_updated
        ));
    }
    
    public function get_terms_data($request) {
        // Get terms of service data from our unified admin system
        $content = get_option('doginvoice_content', array());
        
        // Parse the serialized data if it's a string
        if (is_string($content)) {
            $content = maybe_unserialize($content);
        }
        
        // Extract terms data
        $terms_title = $content['terms_title'] ?? 'Regulamin';
        $terms_content = $content['terms_content'] ?? '';
        $terms_last_updated = $content['terms_last_updated'] ?? date('Y-m-d');
        
        
        return rest_ensure_response(array(
            'title' => $terms_title,
            'content' => $terms_content,
            'last_updated' => $terms_last_updated
        ));
    }
    
    public function create_custom_fields() {
        // Add admin menu for managing DogInvoice settings
        add_action('admin_menu', array($this, 'add_admin_menu'));
    }
    
    public function add_admin_menu() {
        add_options_page(
            'DogInvoice Settings',
            'DogInvoice API',
            'manage_options',
            'doginvoice-settings',
            array($this, 'admin_page')
        );
    }
    
    public function admin_page() {
        if (isset($_POST['submit'])) {
            // Save settings
            foreach ($_POST as $key => $value) {
                if (strpos($key, 'doginvoice_') === 0) {
                    update_option($key, sanitize_text_field($value));
                }
            }
            echo '<div class="notice notice-success"><p>Settings saved!</p></div>';
        }
        
        echo '<div class="wrap">';
        echo '<h1>DogInvoice API Settings</h1>';
        echo '<form method="post">';
        
        echo '<h2>Hero Section</h2>';
        echo '<table class="form-table">';
        echo '<tr><th>Title</th><td><input name="doginvoice_hero_title" value="' . esc_attr(get_option('doginvoice_hero_title', '')) . '" class="regular-text" /></td></tr>';
        echo '<tr><th>Subtitle</th><td><input name="doginvoice_hero_subtitle" value="' . esc_attr(get_option('doginvoice_hero_subtitle', '')) . '" class="regular-text" /></td></tr>';
        echo '<tr><th>Description</th><td><textarea name="doginvoice_hero_description" class="large-text">' . esc_textarea(get_option('doginvoice_hero_description', '')) . '</textarea></td></tr>';
        echo '</table>';
        
        echo '<h2>Numbers Section</h2>';
        echo '<table class="form-table">';
        echo '<tr><th>Invoices Value</th><td><input name="doginvoice_numbers_invoices_value" value="' . esc_attr(get_option('doginvoice_numbers_invoices_value', '70000')) . '" type="number" /></td></tr>';
        echo '<tr><th>Hours Value</th><td><input name="doginvoice_numbers_hours_value" value="' . esc_attr(get_option('doginvoice_numbers_hours_value', '20')) . '" type="number" /></td></tr>';
        echo '<tr><th>Accuracy Value</th><td><input name="doginvoice_numbers_accuracy_value" value="' . esc_attr(get_option('doginvoice_numbers_accuracy_value', '99')) . '" type="number" /></td></tr>';
        echo '</table>';
        
        submit_button();
        echo '</form>';
        echo '</div>';
    }
}

// Initialize the plugin
new DogInvoiceAPI();
?>