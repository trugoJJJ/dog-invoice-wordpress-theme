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
    }
    
    public function get_hero_data($request) {
        // Get data from WordPress options (editable w panelu WordPress)
        $hero_data = array(
            'id' => 1,
            'title' => get_option('doginvoice_hero_title', 'Robisz zdjęcie faktury, a reszta dzieje się automatycznie'),
            'subtitle' => get_option('doginvoice_hero_subtitle', 'DogInvoice - AI Invoice Processing'),
            'description' => get_option('doginvoice_hero_description', 'DogInvoice automatycznie organizuje Twoje dokumenty, eliminuje chaos administracyjny i pozwala Ci skupić się na tym, co naprawdę ważne.'),
            'video_url' => get_option('doginvoice_hero_video_url', '/videos/doginvoice_hero.mp4'),
            'video_poster' => get_option('doginvoice_hero_video_poster', '/doginvoice_hero_frame.png'),
            'cta_primary_text' => get_option('doginvoice_hero_cta_primary_text', 'Wybierz swój plan'),
            'cta_primary_url' => get_option('doginvoice_hero_cta_primary_url', '#pricing'),
            'cta_secondary_text' => get_option('doginvoice_hero_cta_secondary_text', 'Przetestuj za darmo'),
            'cta_secondary_url' => get_option('doginvoice_hero_cta_secondary_url', '/trial'),
        );
        
        return rest_ensure_response($hero_data);
    }
    
    public function get_numbers_data($request) {
        $numbers_data = array(
            array(
                'value' => intval(get_option('doginvoice_numbers_invoices_value', 70000)),
                'suffix' => get_option('doginvoice_numbers_invoices_suffix', '+'),
                'title' => get_option('doginvoice_numbers_invoices_title', 'Przetworzonych faktur'),
                'description' => get_option('doginvoice_numbers_invoices_description', 'przez naszych klientów'),
                'color' => get_option('doginvoice_numbers_invoices_color', 'text-primary'),
            ),
            array(
                'value' => intval(get_option('doginvoice_numbers_hours_value', 20)),
                'suffix' => get_option('doginvoice_numbers_hours_suffix', 'h'),
                'title' => get_option('doginvoice_numbers_hours_title', 'Oszczędności tygodniowo'),
                'description' => get_option('doginvoice_numbers_hours_description', 'średnio na każdego użytkownika'),
                'color' => get_option('doginvoice_numbers_hours_color', 'text-orange-500'),
            ),
            array(
                'value' => intval(get_option('doginvoice_numbers_accuracy_value', 99)),
                'suffix' => get_option('doginvoice_numbers_accuracy_suffix', '%'),
                'title' => get_option('doginvoice_numbers_accuracy_title', 'Dokładność AI'),
                'description' => get_option('doginvoice_numbers_accuracy_description', 'w rozpoznawaniu danych z faktur'),
                'color' => get_option('doginvoice_numbers_accuracy_color', 'text-primary'),
            ),
        );
        
        return rest_ensure_response($numbers_data);
    }
    
    public function get_features_data($request) {
        $features_data = array(
            array(
                'id' => 1,
                'title' => get_option('doginvoice_features_1_title', 'Automatyczne rozpoznawanie'),
                'description' => get_option('doginvoice_features_1_description', 'AI automatycznie wyodrębnia wszystkie kluczowe dane z faktur'),
                'icon' => get_option('doginvoice_features_1_icon', 'brain'),
                'video_url' => get_option('doginvoice_features_1_video_url', ''),
                'highlight' => get_option('doginvoice_features_1_highlight', '99% dokładności'),
            ),
            array(
                'id' => 2,
                'title' => get_option('doginvoice_features_2_title', 'Inteligentna kategoryzacja'),
                'description' => get_option('doginvoice_features_2_description', 'System automatycznie kategoryzuje wydatki zgodnie z planem kont'),
                'icon' => get_option('doginvoice_features_2_icon', 'tags'),
                'video_url' => get_option('doginvoice_features_2_video_url', ''),
                'highlight' => get_option('doginvoice_features_2_highlight', 'Automatyczna klasyfikacja'),
            ),
            array(
                'id' => 3,
                'title' => get_option('doginvoice_features_3_title', 'Bezpieczne archiwum'),
                'description' => get_option('doginvoice_features_3_description', 'Wszystkie dokumenty są bezpiecznie przechowywane w chmurze'),
                'icon' => get_option('doginvoice_features_3_icon', 'shield'),
                'video_url' => get_option('doginvoice_features_3_video_url', ''),
                'highlight' => get_option('doginvoice_features_3_highlight', '100% bezpieczeństwa'),
            ),
        );
        
        return rest_ensure_response($features_data);
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
        $plans = get_pricing_plans();
        
        // Debug: Log pricing plans data
        
        // If no plans from ACF, provide fallback
        if (empty($plans)) {
            $plans = array(
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
                    'monthly_price' => 75,
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
                    'monthly_price' => 150,
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
                ),
                array(
                    'id' => 5,
                    'name' => 'Premium',
                    'plan_id' => 'premium',
                    'description' => 'Plan dostępny tylko rocznie',
                    'invoices' => '1000 faktur miesięcznie.',
                    'monthly_price' => 200,
                    'available_monthly' => false,
                    'available_yearly' => true,
                    'button_text' => 'Wybierz plan',
                    'button_url' => '/trial?plan=premium&billing=yearly',
                    'is_popular' => false,
                    'is_custom_pricing' => false
                )
            );
        }
        
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
    
    // Placeholder methods for other endpoints
    public function get_benefits_data($request) {
        return rest_ensure_response(array());
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
                    'description' => $step['step_description'] ?? "Opis kroku " . ($index + 1)
                );
            }
        }
        
        // If no steps from ACF, provide fallback
        if (empty($steps)) {
            $steps = array(
                array(
                    'id' => 1,
                    'step_number' => 1,
                    'title' => 'Wyślij fakturę',
                    'description' => 'Prześlij fakturę mailem lub przez formularz na stronie'
                ),
                array(
                    'id' => 2,
                    'step_number' => 2,
                    'title' => 'Weryfikacja GUS',
                    'description' => 'System automatycznie weryfikuje dane w bazie GUS'
                ),
                array(
                    'id' => 3,
                    'step_number' => 3,
                    'title' => 'Automatyzacja AI',
                    'description' => 'Algorytm AI przetwarza i kategoryzuje fakturę'
                ),
                array(
                    'id' => 4,
                    'step_number' => 4,
                    'title' => 'Archiwizacja',
                    'description' => 'Faktura jest zapisywana na Twoim Dysku Google'
                ),
                array(
                    'id' => 5,
                    'step_number' => 5,
                    'title' => 'Analiza',
                    'description' => 'Dane są dodawane do dashboardu w czasie rzeczywistym'
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
                $formatted_integrations[] = array(
                    'id' => $index + 1,
                    'title' => $integration['integration_name'],
                    'logo' => $integration['integration_logo'] ?? '',
                    'height' => $integration['integration_height'] ?? 35,
                    'coming_soon' => $integration['integration_coming_soon'] ?? false
                );
            }
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
        return rest_ensure_response(get_faq());
    }
    
    public function get_cta_data($request) {
        return rest_ensure_response(get_cta_data());
    }
    
    public function get_trusted_by_data($request) {
        return rest_ensure_response(array());
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