<?php
/**
 * Setup script for DogInvoice theme
 * Run this file directly in browser: http://localhost:8080/wp-content/themes/doginvoice/setup.php
 */

// Load WordPress
require_once('../../../wp-load.php');

// Check if user is admin
if (!current_user_can('manage_options')) {
    wp_die('You do not have permission to run this script.');
}

echo '<h1>DogInvoice Theme Setup</h1>';

// Check if ACF is active
if (!function_exists('acf_add_local_field_group')) {
    echo '<p style="color: red;">❌ ACF plugin is not active. Please install and activate Advanced Custom Fields first.</p>';
    exit;
}

echo '<p style="color: green;">✅ ACF plugin is active.</p>';

// Import ACF fields
echo '<h2>Importing ACF Fields...</h2>';
require_once get_template_directory() . '/acf-fields.php';
echo '<p style="color: green;">✅ ACF fields imported.</p>';

// Import sample data
echo '<h2>Importing Sample Data...</h2>';
require_once get_template_directory() . '/data-import.php';
echo '<p style="color: green;">✅ Sample data imported.</p>';

echo '<h2>Setup Complete!</h2>';
echo '<p><a href="' . home_url() . '">View your site</a> | <a href="' . admin_url() . '">Go to Admin</a></p>';
?>
