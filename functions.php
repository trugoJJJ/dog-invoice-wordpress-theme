<?php
/**
 * DogInvoice WordPress Theme Functions
 */

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

// Register Custom Post Types
function create_doginvoice_post_types() {
    // Hero Section
    register_post_type('doginvoice_hero', array(
        'labels' => array(
            'name' => 'Hero Section',
            'singular_name' => 'Hero Section',
            'add_new' => 'Dodaj nowy',
            'add_new_item' => 'Dodaj nową sekcję Hero',
            'edit_item' => 'Edytuj sekcję Hero',
            'new_item' => 'Nowa sekcja Hero',
            'view_item' => 'Zobacz sekcję Hero',
            'search_items' => 'Szukaj sekcji Hero',
            'not_found' => 'Nie znaleziono sekcji Hero',
            'not_found_in_trash' => 'Nie znaleziono sekcji Hero w koszu'
        ),
        'public' => true,
        'has_archive' => false,
        'supports' => array('title', 'editor'),
        'menu_icon' => 'dashicons-admin-home',
        'show_in_rest' => true
    ));

    // Process Steps
    register_post_type('process_steps', array(
        'labels' => array(
            'name' => 'Kroki procesu',
            'singular_name' => 'Krok procesu',
            'add_new' => 'Dodaj nowy krok',
            'add_new_item' => 'Dodaj nowy krok procesu',
            'edit_item' => 'Edytuj krok procesu',
            'new_item' => 'Nowy krok procesu',
            'view_item' => 'Zobacz krok procesu',
            'search_items' => 'Szukaj kroków procesu',
            'not_found' => 'Nie znaleziono kroków procesu',
            'not_found_in_trash' => 'Nie znaleziono kroków procesu w koszu'
        ),
        'public' => true,
        'has_archive' => false,
        'supports' => array('title', 'editor'),
        'menu_icon' => 'dashicons-list-view',
        'show_in_rest' => true,
        'menu_position' => 5
    ));

    // Features
    register_post_type('features', array(
        'labels' => array(
            'name' => 'Funkcjonalności',
            'singular_name' => 'Funkcjonalność',
            'add_new' => 'Dodaj nową funkcjonalność',
            'add_new_item' => 'Dodaj nową funkcjonalność',
            'edit_item' => 'Edytuj funkcjonalność',
            'new_item' => 'Nowa funkcjonalność',
            'view_item' => 'Zobacz funkcjonalność',
            'search_items' => 'Szukaj funkcjonalności',
            'not_found' => 'Nie znaleziono funkcjonalności',
            'not_found_in_trash' => 'Nie znaleziono funkcjonalności w koszu'
        ),
        'public' => true,
        'has_archive' => false,
        'supports' => array('title', 'editor'),
        'menu_icon' => 'dashicons-star-filled',
        'show_in_rest' => true,
        'menu_position' => 6
    ));

    // Integrations
    register_post_type('integrations', array(
        'labels' => array(
            'name' => 'Integracje',
            'singular_name' => 'Integracja',
            'add_new' => 'Dodaj nową integrację',
            'add_new_item' => 'Dodaj nową integrację',
            'edit_item' => 'Edytuj integrację',
            'new_item' => 'Nowa integracja',
            'view_item' => 'Zobacz integrację',
            'search_items' => 'Szukaj integracji',
            'not_found' => 'Nie znaleziono integracji',
            'not_found_in_trash' => 'Nie znaleziono integracji w koszu'
        ),
        'public' => true,
        'has_archive' => false,
        'supports' => array('title', 'editor'),
        'menu_icon' => 'dashicons-admin-plugins',
        'show_in_rest' => true,
        'menu_position' => 7
    ));

    // Benefits
    register_post_type('benefits', array(
        'labels' => array(
            'name' => 'Korzyści',
            'singular_name' => 'Korzyść',
            'add_new' => 'Dodaj nową korzyść',
            'add_new_item' => 'Dodaj nową korzyść',
            'edit_item' => 'Edytuj korzyść',
            'new_item' => 'Nowa korzyść',
            'view_item' => 'Zobacz korzyść',
            'search_items' => 'Szukaj korzyści',
            'not_found' => 'Nie znaleziono korzyści',
            'not_found_in_trash' => 'Nie znaleziono korzyści w koszu'
        ),
        'public' => true,
        'has_archive' => false,
        'supports' => array('title', 'editor'),
        'menu_icon' => 'dashicons-yes-alt',
        'show_in_rest' => true,
        'menu_position' => 8
    ));

    // FAQ
    register_post_type('faq', array(
        'labels' => array(
            'name' => 'FAQ',
            'singular_name' => 'Pytanie',
            'add_new' => 'Dodaj nowe pytanie',
            'add_new_item' => 'Dodaj nowe pytanie',
            'edit_item' => 'Edytuj pytanie',
            'new_item' => 'Nowe pytanie',
            'view_item' => 'Zobacz pytanie',
            'search_items' => 'Szukaj pytań',
            'not_found' => 'Nie znaleziono pytań',
            'not_found_in_trash' => 'Nie znaleziono pytań w koszu'
        ),
        'public' => true,
        'has_archive' => false,
        'supports' => array('title', 'editor'),
        'menu_icon' => 'dashicons-editor-help',
        'show_in_rest' => true,
        'menu_position' => 9
    ));

    // Pricing Plans
    register_post_type('pricing_plans', array(
        'labels' => array(
            'name' => 'Plany cenowe',
            'singular_name' => 'Plan cenowy',
            'add_new' => 'Dodaj nowy plan',
            'add_new_item' => 'Dodaj nowy plan cenowy',
            'edit_item' => 'Edytuj plan cenowy',
            'new_item' => 'Nowy plan cenowy',
            'view_item' => 'Zobacz plan cenowy',
            'search_items' => 'Szukaj planów cenowych',
            'not_found' => 'Nie znaleziono planów cenowych',
            'not_found_in_trash' => 'Nie znaleziono planów cenowych w koszu'
        ),
        'public' => true,
        'has_archive' => false,
        'supports' => array('title', 'editor'),
        'menu_icon' => 'dashicons-money-alt',
        'show_in_rest' => true,
        'menu_position' => 10
    ));
}
add_action('init', 'create_doginvoice_post_types');

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
}
add_action('rest_api_init', 'register_doginvoice_rest_routes');

// REST API callback functions
function get_hero_data() {
    $hero_posts = get_posts(array(
        'post_type' => 'doginvoice_hero',
        'posts_per_page' => 1,
        'post_status' => 'publish'
    ));

    if (empty($hero_posts)) {
        return new WP_Error('no_hero', 'No hero section found', array('status' => 404));
    }

    $hero = $hero_posts[0];
    
    return array(
        'id' => $hero->ID,
        'title' => get_field('hero_title', $hero->ID),
        'subtitle' => get_field('hero_subtitle', $hero->ID),
        'description' => get_field('hero_description', $hero->ID),
        'video_url' => get_field('hero_video_url', $hero->ID),
        'video_poster' => get_field('hero_video_poster', $hero->ID),
        'cta_primary_text' => get_field('hero_cta_primary_text', $hero->ID),
        'cta_primary_url' => get_field('hero_cta_primary_url', $hero->ID),
        'cta_secondary_text' => get_field('hero_cta_secondary_text', $hero->ID),
        'cta_secondary_url' => get_field('hero_cta_secondary_url', $hero->ID)
    );
}

function get_process_steps() {
    $steps = get_posts(array(
        'post_type' => 'process_steps',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'menu_order',
        'order' => 'ASC'
    ));

    $formatted_steps = array();
    foreach ($steps as $step) {
        $formatted_steps[] = array(
            'id' => $step->ID,
            'number' => get_field('step_number', $step->ID),
            'title' => $step->post_title,
            'description' => $step->post_content,
            'icon' => get_field('step_icon', $step->ID),
            'video_url' => get_field('step_video_url', $step->ID),
            'position' => array(
                'x' => get_field('step_position_x', $step->ID),
                'y' => get_field('step_position_y', $step->ID)
            )
        );
    }

    return $formatted_steps;
}

function get_features() {
    $features = get_posts(array(
        'post_type' => 'features',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'menu_order',
        'order' => 'ASC'
    ));

    $formatted_features = array();
    foreach ($features as $feature) {
        $formatted_features[] = array(
            'id' => $feature->ID,
            'title' => $feature->post_title,
            'description' => $feature->post_content,
            'icon' => get_field('feature_icon', $feature->ID),
            'video_url' => get_field('feature_video_url', $feature->ID),
            'highlight' => get_field('feature_highlight', $feature->ID)
        );
    }

    return $formatted_features;
}

function get_integrations() {
    $integrations = get_posts(array(
        'post_type' => 'integrations',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'menu_order',
        'order' => 'ASC'
    ));

    $formatted_integrations = array();
    foreach ($integrations as $integration) {
        $formatted_integrations[] = array(
            'id' => $integration->ID,
            'name' => $integration->post_title,
            'description' => $integration->post_content,
            'logo' => get_field('integration_logo', $integration->ID),
            'url' => get_field('integration_url', $integration->ID),
            'coming_soon' => get_field('integration_coming_soon', $integration->ID)
        );
    }

    return $formatted_integrations;
}

function get_benefits() {
    $benefits = get_posts(array(
        'post_type' => 'benefits',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'menu_order',
        'order' => 'ASC'
    ));

    $formatted_benefits = array();
    foreach ($benefits as $benefit) {
        $formatted_benefits[] = array(
            'id' => $benefit->ID,
            'title' => $benefit->post_title,
            'description' => $benefit->post_content,
            'icon' => get_field('benefit_icon', $benefit->ID),
            'highlight' => get_field('benefit_highlight', $benefit->ID)
        );
    }

    return $formatted_benefits;
}

function get_faq() {
    $faqs = get_posts(array(
        'post_type' => 'faq',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'menu_order',
        'order' => 'ASC'
    ));

    $formatted_faqs = array();
    foreach ($faqs as $faq) {
        $formatted_faqs[] = array(
            'id' => $faq->ID,
            'question' => $faq->post_title,
            'answer' => $faq->post_content
        );
    }

    return $formatted_faqs;
}

function get_pricing_plans() {
    $plans = get_posts(array(
        'post_type' => 'pricing_plans',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'menu_order',
        'order' => 'ASC'
    ));

    $formatted_plans = array();
    foreach ($plans as $plan) {
        $formatted_plans[] = array(
            'id' => $plan->ID,
            'name' => $plan->post_title,
            'description' => $plan->post_content,
            'price' => get_field('plan_price', $plan->ID),
            'period' => get_field('plan_period', $plan->ID),
            'features' => get_field('plan_features', $plan->ID),
            'cta_text' => get_field('plan_cta_text', $plan->ID),
            'cta_url' => get_field('plan_cta_url', $plan->ID),
            'popular' => get_field('plan_popular', $plan->ID)
        );
    }

    return $formatted_plans;
}

// Helper function to get ACF field with fallback
function get_doginvoice_field($field_name, $post_id = null, $default = '') {
    $value = get_field($field_name, $post_id);
    return $value ? $value : $default;
}
?>
