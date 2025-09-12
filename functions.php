<?php
/**
 * DogInvoice WordPress Theme Functions
 */

// Include unified admin interface
require_once get_template_directory() . '/unified-admin.php';

// Enqueue styles and scripts
function doginvoice_enqueue_scripts() {
    wp_enqueue_style('doginvoice-style', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0.0');
    wp_enqueue_script('doginvoice-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);
    
    // Localize script for AJAX
    wp_localize_script('doginvoice-script', 'doginvoice_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('doginvoice_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'doginvoice_enqueue_scripts');

// Remove Gutenberg block comments from content
function remove_gutenberg_comments($content) {
    if (empty($content) || !is_string($content)) {
        return $content;
    }
    
    // Remove wp:paragraph comments
    $content = preg_replace('/<!-- wp:paragraph -->/', '', $content);
    $content = preg_replace('/<!-- \/wp:paragraph -->/', '', $content);
    
    // Remove other common Gutenberg comments
    $content = preg_replace('/<!-- wp:[^>]* -->/', '', $content);
    $content = preg_replace('/<!-- \/wp:[^>]* -->/', '', $content);
    
    // Remove any remaining HTML comments
    $content = preg_replace('/<!--.*?-->/s', '', $content);
    
    return $content;
}

// Apply to all content filters
add_filter('the_content', 'remove_gutenberg_comments', 20);
add_filter('get_the_content', 'remove_gutenberg_comments', 20);
add_filter('the_excerpt', 'remove_gutenberg_comments', 20);
add_filter('the_title', 'remove_gutenberg_comments', 20);

// Also remove from ACF fields
function remove_gutenberg_from_acf($value, $post_id, $field) {
    if (is_string($value)) {
        $value = remove_gutenberg_comments($value);
    }
    return $value;
}
add_filter('acf/load_value', 'remove_gutenberg_from_acf', 10, 3);
add_filter('acf/format_value', 'remove_gutenberg_from_acf', 10, 3);

// Remove from post content directly
function clean_post_content($content) {
    return remove_gutenberg_comments($content);
}
add_filter('content_save_pre', 'clean_post_content');

// Additional aggressive cleaning for display
function aggressive_gutenberg_cleanup($content) {
    if (empty($content) || !is_string($content)) {
        return $content;
    }
    
    // Remove all HTML comments
    $content = preg_replace('/<!--.*?-->/s', '', $content);
    
    // Remove specific Gutenberg patterns
    $patterns = array(
        '/<!-- wp:paragraph -->/',
        '/<!-- \/wp:paragraph -->/',
        '/<!-- wp:heading[^>]*? -->/',
        '/<!-- \/wp:heading -->/',
        '/<!-- wp:quote[^>]*? -->/',
        '/<!-- \/wp:quote -->/',
        '/<!-- wp:list[^>]*? -->/',
        '/<!-- \/wp:list -->/',
        '/<!-- wp:[^>]*? \/>/',
        '/<!-- wp:[^>]*? -->/',
        '/<!-- \/wp:[^>]*? -->/'
    );
    
    foreach ($patterns as $pattern) {
        $content = preg_replace($pattern, '', $content);
    }
    
    return $content;
}

// Comprehensive HTML cleanup function
function comprehensive_html_cleanup($content) {
    if (empty($content) || !is_string($content)) {
        return $content;
    }
    
    // Remove HTML comments
    $content = preg_replace('/<!--.*?-->/s', '', $content);
    
    // Remove non-breaking spaces
    $content = str_replace('&nbsp;', ' ', $content);
    $content = str_replace('&#160;', ' ', $content);
    $content = str_replace('&amp;nbsp;', ' ', $content);
    
    // Remove empty paragraph tags
    $content = preg_replace('/<p[^>]*>\s*<\/p>/i', '', $content);
    $content = preg_replace('/<p[^>]*>&nbsp;<\/p>/i', '', $content);
    
    // Remove paragraph tags but keep content
    $content = preg_replace('/<\/?p[^>]*>/i', '', $content);
    
    // Remove other common HTML tags that might be problematic
    $content = preg_replace('/<\/?div[^>]*>/i', '', $content);
    $content = preg_replace('/<\/?span[^>]*>/i', '', $content);
    $content = preg_replace('/<\/?br[^>]*>/i', '', $content);
    
    // Clean up multiple spaces
    $content = preg_replace('/\s+/', ' ', $content);
    $content = trim($content);
    
    return $content;
}

// Disable wpautop to prevent automatic paragraph tags
remove_filter('the_content', 'wpautop');
remove_filter('the_excerpt', 'wpautop');
remove_filter('acf_the_content', 'wpautop');

// Apply comprehensive cleanup to all content
add_filter('the_content', 'comprehensive_html_cleanup', 99);
add_filter('get_the_content', 'comprehensive_html_cleanup', 99);
add_filter('the_excerpt', 'comprehensive_html_cleanup', 99);
add_filter('the_title', 'comprehensive_html_cleanup', 99);

// Apply to ACF fields as well
add_filter('acf/load_value', function($value, $post_id, $field) {
    if (is_string($value)) {
        $value = comprehensive_html_cleanup($value);
    }
    return $value;
}, 99, 3);

add_filter('acf/format_value', function($value, $post_id, $field) {
    if (is_string($value)) {
        $value = comprehensive_html_cleanup($value);
    }
    return $value;
}, 99, 3);

// Also apply to ACF field display
add_filter('acf_the_content', 'comprehensive_html_cleanup', 99);


// Add theme support
function doginvoice_theme_support() {
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
}
add_action('after_setup_theme', 'doginvoice_theme_support');

// Custom REST API endpoints
function register_doginvoice_rest_routes() {
    register_rest_route('doginvoice/v1', '/hero', array(
        'methods' => 'GET',
        'callback' => 'get_hero_data',
        'permission_callback' => '__return_true'
    ));

    register_rest_route('doginvoice/v1', '/steps', array(
        'methods' => 'GET',
        'callback' => 'get_process_steps',
        'permission_callback' => '__return_true'
    ));

    register_rest_route('doginvoice/v1', '/process', array(
        'methods' => 'GET',
        'callback' => 'get_process_steps',
        'permission_callback' => '__return_true'
    ));

    register_rest_route('doginvoice/v1', '/features', array(
        'methods' => 'GET',
        'callback' => 'get_features',
        'permission_callback' => '__return_true'
    ));

    register_rest_route('doginvoice/v1', '/integrations', array(
        'methods' => 'GET',
        'callback' => 'get_integrations',
        'permission_callback' => '__return_true'
    ));

    register_rest_route('doginvoice/v1', '/benefits', array(
        'methods' => 'GET',
        'callback' => 'get_benefits',
        'permission_callback' => '__return_true'
    ));

    register_rest_route('doginvoice/v1', '/faq', array(
        'methods' => 'GET',
        'callback' => 'get_faq',
        'permission_callback' => '__return_true'
    ));

    register_rest_route('doginvoice/v1', '/pricing', array(
        'methods' => 'GET',
        'callback' => 'get_pricing_plans',
        'permission_callback' => '__return_true'
    ));

    register_rest_route('doginvoice/v1', '/cta', array(
        'methods' => 'GET',
        'callback' => 'get_cta_data',
        'permission_callback' => '__return_true'
    ));

    register_rest_route('doginvoice/v1', '/trusted-by', array(
        'methods' => 'GET',
        'callback' => 'get_trusted_by_data',
        'permission_callback' => '__return_true'
    ));

    register_rest_route('doginvoice/v1', '/numbers', array(
        'methods' => 'GET',
        'callback' => 'get_animated_numbers',
        'permission_callback' => '__return_true'
    ));

    register_rest_route('doginvoice/v1', '/form', array(
        'methods' => 'GET',
        'callback' => 'get_form_data',
        'permission_callback' => '__return_true'
    ));

    register_rest_route('doginvoice/v1', '/privacy', array(
        'methods' => 'GET',
        'callback' => 'get_privacy_data',
        'permission_callback' => '__return_true'
    ));

    register_rest_route('doginvoice/v1', '/terms', array(
        'methods' => 'GET',
        'callback' => 'get_terms_data',
        'permission_callback' => '__return_true'
    ));
}
add_action('rest_api_init', 'register_doginvoice_rest_routes');

// REST API callback functions
function get_hero_data() {
    $content = get_doginvoice_content();
    return array(
        'title' => comprehensive_html_cleanup($content['hero_title'] ?? 'Robisz zdjęcie faktury, a reszta dzieje się automatycznie'),
        'description' => comprehensive_html_cleanup($content['hero_description'] ?? 'DogInvoice automatycznie organizuje Twoje dokumenty, eliminuje chaos administracyjny i pozwala Ci skupić się na tym, co naprawdę ważne.'),
        'video_url' => $content['hero_video_url'] ?? '/videos/doginvoice_hero.mp4',
        'video_poster' => $content['hero_video_poster'] ?? '/doginvoice_hero_frame.png',
        'cta_primary_text' => $content['hero_cta_primary_text'] ?? 'Wybierz swój plan',
        'cta_primary_url' => $content['hero_cta_primary_url'] ?? '#pricing',
        'cta_secondary_text' => $content['hero_cta_secondary_text'] ?? 'Przetestuj za darmo',
        'cta_secondary_url' => $content['hero_cta_secondary_url'] ?? '/trial'
    );
}

function get_process_steps() {
    $content = get_doginvoice_content();
    $steps = $content['process_steps'] ?? array();
    $formatted_steps = array();
    
    foreach ($steps as $step) {
        $formatted_steps[] = array(
            'number' => $step['step_number'],
            'title' => comprehensive_html_cleanup($step['step_title']),
            'description' => comprehensive_html_cleanup($step['step_description']),
            'icon' => $step['step_icon'],
            'thumbnail' => $step['step_thumbnail_url'] ?? '',
            'video_url' => $step['step_video_url'],
            'position' => array(
                'x' => $step['step_position_x'],
                'y' => $step['step_position_y']
            )
        );
    }

    return $formatted_steps;
}

function get_features() {
    $content = get_doginvoice_content();
    $features = $content['features'] ?? array();
    $formatted_features = array();
    
    foreach ($features as $feature) {
        $formatted_features[] = array(
            'title' => comprehensive_html_cleanup($feature['feature_title']),
            'description' => comprehensive_html_cleanup($feature['feature_description']),
            'icon' => $feature['feature_icon'],
            'video' => $feature['feature_video_url'],
            'poster' => $feature['feature_poster_url'] ?? ''
        );
    }

    return array(
        'title' => comprehensive_html_cleanup($content['features_title'] ?? 'Zmień sposób zarządzania finansami'),
        'description' => comprehensive_html_cleanup($content['features_description'] ?? 'Poznaj trzy fundamenty, które poprawią wydajność pracy księgowej.'),
        'features' => $formatted_features
    );
}

function get_integrations() {
    $content = get_doginvoice_content();
    $integrations = $content['integrations'] ?? array();
    $formatted_integrations = array();
    
    foreach ($integrations as $integration) {
        $formatted_integrations[] = array(
            'title' => comprehensive_html_cleanup($integration['integration_name']),
            'component' => $integration['integration_component'] ?? '',
            'height' => $integration['integration_height'] ?? 'h-[30px]',
            'comingSoon' => $integration['integration_coming_soon'] ?? false
        );
    }

    return $formatted_integrations;
}

function get_benefits() {
    $content = get_doginvoice_content();
    $benefits = $content['benefits'] ?? array();
    $formatted_benefits = array();
    
    foreach ($benefits as $benefit) {
        $formatted_benefits[] = array(
            'title' => comprehensive_html_cleanup($benefit['benefit_title']),
            'description' => comprehensive_html_cleanup($benefit['benefit_description']),
            'icon' => $benefit['benefit_icon'],
            'highlight' => comprehensive_html_cleanup($benefit['benefit_highlight'])
        );
    }

    return array(
        'title' => comprehensive_html_cleanup($content['benefits_title'] ?? 'Funkcjonalności automatyzujące pracę księgowości'),
        'description' => comprehensive_html_cleanup($content['benefits_description'] ?? 'Poznaj główne zalety naszego systemu.'),
        'items' => $formatted_benefits
    );
}

function get_faq() {
    $content = get_doginvoice_content();
    $faqs = $content['faq'] ?? array();
    $formatted_faqs = array();
    
    foreach ($faqs as $faq) {
        $formatted_faqs[] = array(
            'question' => comprehensive_html_cleanup($faq['faq_question']),
            'answer' => comprehensive_html_cleanup($faq['faq_answer'])
        );
    }

    return $formatted_faqs;
}

function get_pricing_plans() {
    $content = get_doginvoice_content();
    $plans = $content['pricing_plans'] ?? array();
    $formatted_plans = array();
    
    foreach ($plans as $plan) {
        $formatted_plans[] = array(
            'name' => comprehensive_html_cleanup($plan['plan_name']),
            'id' => $plan['plan_id'] ?? '',
            'description' => comprehensive_html_cleanup($plan['plan_description']),
            'invoices' => $plan['plan_invoices'] ?? '',
            'monthlyPrice' => intval($plan['plan_monthly_price'] ?? 0),
            'buttonText' => $plan['plan_button_text'] ?? '',
            'buttonUrl' => $plan['plan_button_url'] ?? '',
            'isPopular' => $plan['plan_is_popular'] ?? false
        );
    }

    return $formatted_plans;
}

function get_animated_numbers() {
    $content = get_doginvoice_content();
    return $content['animated_numbers'] ?? array();
}

function get_cta_data() {
    $content = get_doginvoice_content();
    return array(
        'title' => comprehensive_html_cleanup($content['cta_title'] ?? 'Zacznij już dziś'),
        'subtitle' => comprehensive_html_cleanup($content['cta_subtitle'] ?? 'Dołącz do firm, które oszczędzają 15 godzin tygodniowo dzięki automatyzacji.'),
        'button_primary_text' => $content['cta_button_primary_text'] ?? 'Wybierz swój plan',
        'button_primary_url' => $content['cta_button_primary_url'] ?? '#pricing',
        'button_secondary_text' => $content['cta_button_secondary_text'] ?? 'Przetestuj za darmo',
        'button_secondary_url' => $content['cta_button_secondary_url'] ?? '/trial'
    );
}

function get_trusted_by_data() {
    $content = get_doginvoice_content();
    $logos = $content['trusted_by']['trusted_by_logos'] ?? array();
    $formatted_logos = array();
    
    foreach ($logos as $logo) {
        $formatted_logos[] = array(
            'name' => $logo['logo_name'] ?? '',
            'url' => $logo['logo_url'] ?? '',
            'logo' => $logo['logo_path'] ?? '',
            'height' => $logo['logo_height'] ?? 'h-[30px]'
        );
    }
    
    return array(
        'title' => comprehensive_html_cleanup($content['trusted_by']['trusted_by_title'] ?? 'Z DogInvoice już korzystają'),
        'logos' => $formatted_logos
    );
}

// Helper function to get ACF field with fallback
function get_doginvoice_field($field_name, $post_id = null, $default = '') {
    $value = get_field($field_name, $post_id);
    return $value ? $value : $default;
}

function get_form_data() {
    $content = get_doginvoice_content();
    
    // Pobierz plany z cennika zamiast z formularza
    $pricing_plans = $content['pricing_plans'] ?? array();
    $form_plans = array();
    
    foreach ($pricing_plans as $plan) {
        $form_plans[] = array(
            'id' => $plan['plan_id'] ?? '',
            'name' => $plan['plan_name'] ?? '',
            'monthly' => array(
                'price' => $plan['plan_monthly_price'] ? $plan['plan_monthly_price'] . ' zł netto/mies.' : '0 zł',
                'description' => $plan['plan_invoices'] ?? ''
            ),
            'yearly' => $plan['plan_monthly_price'] ? array(
                'price' => round($plan['plan_monthly_price'] * 0.5) . ' zł netto/mies.',
                'description' => 'Oszczędzasz ' . round($plan['plan_monthly_price'] * 6) . ' zł rocznie'
            ) : null
        );
    }
    
    return array(
        'title' => comprehensive_html_cleanup($content['form_title'] ?? 'Wybierz swój plan i rozpocznij test'),
        'description' => comprehensive_html_cleanup($content['form_description'] ?? 'Wypełnij formularz, a nasz konsultant skontaktuje się z Tobą w celu finalizacji transakcji.'),
        'webhook_url' => $content['form_webhook_url'] ?? '',
        'industries' => $content['form_industries'] ?? array(),
        'plans' => $form_plans
    );
}

function get_privacy_data() {
    $content = get_doginvoice_content();
    return array(
        'title' => comprehensive_html_cleanup($content['privacy_title'] ?? 'Polityka prywatności i cookies'),
        'content' => $content['privacy_content'] ?? '',
        'last_updated' => $content['privacy_last_updated'] ?? date('Y-m-d')
    );
}

function get_terms_data() {
    $content = get_doginvoice_content();
    return array(
        'title' => comprehensive_html_cleanup($content['terms_title'] ?? 'Regulamin'),
        'content' => $content['terms_content'] ?? '',
        'last_updated' => $content['terms_last_updated'] ?? date('Y-m-d')
    );
}






?>
