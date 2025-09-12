<?php
/**
 * Import sample data for DogInvoice theme
 * Run this after ACF is installed and theme is activated
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

function doginvoice_import_sample_data() {
    // Check if ACF is active
    if (!function_exists('acf_add_local_field_group')) {
        wp_die('ACF plugin is not active. Please install and activate Advanced Custom Fields first.');
    }

    // Import ACF fields
    require_once get_template_directory() . '/acf-fields.php';
    
    // Import sample data
    require_once get_template_directory() . '/data-import.php';
    
    echo '<div class="notice notice-success"><p>Sample data imported successfully!</p></div>';
}

// Add admin menu
add_action('admin_menu', function() {
    add_theme_page(
        'Import Sample Data',
        'Import Sample Data',
        'manage_options',
        'doginvoice-import',
        'doginvoice_import_sample_data'
    );
});
?>
