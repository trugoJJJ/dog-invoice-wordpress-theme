<?php
/**
 * Test script to insert ACF data into WordPress
 * Run this from WordPress admin or via WP-CLI
 */

// Load WordPress
require_once('/var/www/html/wp-config.php');

// Test data structure for pricing section
$test_content = array(
    'pricing_title' => 'Wybierz swój plan',
    'pricing_description' => 'Wypełnij formularz, a nasz konsultant skontaktuje się z Tobą w celu finalizacji transakcji.',
    'pricing_footer_text' => 'Podane ceny są cenami netto. Potrzebujesz więcej informacji? Skontaktuj się z nami',
    'pricing_footer_button_text' => 'Skontaktuj się z nami',
    'pricing_footer_button_url' => '#contact',
    
    // Switch settings
    'pricing_switch_monthly_label' => 'Miesięcznie',
    'pricing_switch_yearly_label' => 'Rocznie',
    'pricing_yearly_discount_percent' => 30,
    
    // Pricing plans
    'pricing_plans' => array(
        array(
            'plan_name' => 'Starter',
            'plan_id' => 'starter',
            'plan_description' => 'Na dobry początek.',
            'plan_invoices' => '10 faktur miesięcznie',
            'plan_monthly_price' => 0,
            'plan_available_monthly' => true,
            'plan_available_yearly' => false,
            'plan_button_text' => 'Rozpocznij za darmo',
            'plan_button_url' => '/trial?plan=starter&billing=monthly',
            'plan_is_popular' => false,
            'plan_is_custom_pricing' => false
        ),
        array(
            'plan_name' => 'Professional',
            'plan_id' => 'professional',
            'plan_description' => 'Dla rozwijających się firm.',
            'plan_invoices' => '150 faktur miesięcznie',
            'plan_monthly_price' => 149,
            'plan_available_monthly' => true,
            'plan_available_yearly' => true,
            'plan_button_text' => 'Wybierz plan',
            'plan_button_url' => '/trial?plan=professional&billing=monthly',
            'plan_is_popular' => true,
            'plan_is_custom_pricing' => false
        ),
        array(
            'plan_name' => 'Business',
            'plan_id' => 'business',
            'plan_description' => 'Dla większych firm.',
            'plan_invoices' => '500 faktur miesięcznie',
            'plan_monthly_price' => 299,
            'plan_available_monthly' => true,
            'plan_available_yearly' => true,
            'plan_button_text' => 'Wybierz plan',
            'plan_button_url' => '/trial?plan=business&billing=monthly',
            'plan_is_popular' => false,
            'plan_is_custom_pricing' => false
        ),
        array(
            'plan_name' => 'Enterprise',
            'plan_id' => 'enterprise',
            'plan_description' => 'Dla tych, którzy potrzebują więcej',
            'plan_invoices' => 'Niestandardowe rozwiązania',
            'plan_monthly_price' => 0,
            'plan_available_monthly' => false,
            'plan_available_yearly' => true,
            'plan_button_text' => 'Skontaktuj się',
            'plan_button_url' => '/trial?plan=enterprise&billing=monthly',
            'plan_is_popular' => false,
            'plan_is_custom_pricing' => true
        )
    )
);

// Insert data into WordPress options
$result = update_option('doginvoice_content', $test_content);

if ($result) {
    echo "✅ Test data inserted successfully!\n";
    echo "🔍 You can now test the pricing section with ACF data.\n";
} else {
    echo "❌ Failed to insert test data.\n";
}

// Verify the data was inserted
$inserted_data = get_option('doginvoice_content', array());
if (!empty($inserted_data['pricing_plans'])) {
    echo "✅ Data verified - " . count($inserted_data['pricing_plans']) . " pricing plans found.\n";
    
    // Check if Enterprise has custom pricing
    $enterprise_plan = null;
    foreach ($inserted_data['pricing_plans'] as $plan) {
        if ($plan['plan_id'] === 'enterprise') {
            $enterprise_plan = $plan;
            break;
        }
    }
    
    if ($enterprise_plan) {
        echo "🔍 Enterprise plan custom pricing: " . ($enterprise_plan['plan_is_custom_pricing'] ? 'YES' : 'NO') . "\n";
        echo "🔍 Enterprise plan yearly only: " . ($enterprise_plan['plan_available_yearly'] && !$enterprise_plan['plan_available_monthly'] ? 'YES' : 'NO') . "\n";
    }
} else {
    echo "❌ Data verification failed - no pricing plans found.\n";
}

echo "\n📋 Next steps:\n";
echo "1. Check WordPress API: http://localhost:8080/wp-json/doginvoice/v1/pricing\n";
echo "2. Test the pricing component on the frontend\n";
echo "3. Verify Enterprise shows 'Wycena indywidualna'\n";
echo "4. Check if switcher shows correct discount percentage\n";
?>
