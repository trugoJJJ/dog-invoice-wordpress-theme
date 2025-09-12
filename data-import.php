<?php
/**
 * Data Import Script for DogInvoice WordPress Theme
 * 
 * This script imports all content from the original Next.js application
 * into WordPress using ACF fields.
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Check if we should run the import
if (!isset($_GET['run_import']) || $_GET['run_import'] !== 'true') {
    echo '<h1>DogInvoice Data Import</h1>';
    echo '<p>To run the import, add <code>?run_import=true</code> to the URL.</p>';
    echo '<p><a href="?run_import=true" class="button button-primary">Run Import</a></p>';
    exit;
}

// Check if ACF is active
if (!function_exists('acf_add_local_field_group')) {
    echo '<h1>Error</h1>';
    echo '<p>Advanced Custom Fields plugin is not active. Please install and activate ACF first.</p>';
    exit;
}

echo '<h1>DogInvoice Data Import</h1>';
echo '<p>Starting import process...</p>';

// Import Hero Section Data
echo '<h2>Importing Hero Section...</h2>';
$hero_post_id = wp_insert_post(array(
    'post_title' => 'Hero Section',
    'post_content' => '',
    'post_status' => 'publish',
    'post_type' => 'dog_hero',
    'post_author' => 1,
));

if ($hero_post_id) {
    // Hero fields
    update_field('hero_title', 'Robisz zdjęcie faktury, a reszta dzieje się automatycznie', $hero_post_id);
    update_field('hero_subtitle', 'DogInvoice automatycznie organizuje Twoje dokumenty, eliminuje chaos administracyjny i pozwala Ci skupić się na tym, co naprawdę ważne.', $hero_post_id);
    update_field('hero_video_url', '/videos/doginvoice_hero.mp4', $hero_post_id);
    update_field('hero_video_poster', '/doginvoice_hero_frame.png', $hero_post_id);
    update_field('hero_cta_primary_text', 'Wybierz swój plan', $hero_post_id);
    update_field('hero_cta_primary_url', '#pricing', $hero_post_id);
    update_field('hero_cta_secondary_text', 'Przetestuj za darmo', $hero_post_id);
    update_field('hero_cta_secondary_url', '/trial', $hero_post_id);
    
    // Animated Numbers
    $animated_numbers = array(
        array(
            'value' => 50000,
            'suffix' => '+',
            'title' => 'Przetworzonych faktur',
            'description' => 'przez naszych klientów',
            'color' => 'text-primary'
        ),
        array(
            'value' => 15,
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
    update_field('animated_numbers', $animated_numbers, $hero_post_id);
    
    // Trusted By
    update_field('trusted_by_title', 'Z DogInvoice już korzystają', $hero_post_id);
    $trusted_by_logos = array(
        array(
            'name' => 'Dogtronic',
            'url' => 'https://dogtronic.io/',
            'image' => '/assets/dog_logo.svg',
            'height' => 20
        ),
        array(
            'name' => 'Kryptobot',
            'url' => 'https://kryptobot.net/',
            'image' => '/assets/kryptobot_logo.svg',
            'height' => 35
        ),
        array(
            'name' => 'Estacluster',
            'url' => 'https://estacluster.com/',
            'image' => '/assets/esta_logo.svg',
            'height' => 30
        ),
        array(
            'name' => 'Doza',
            'url' => 'https://doza.life/',
            'image' => '/assets/doza_logo.svg',
            'height' => 35
        )
    );
    update_field('trusted_by_logos', $trusted_by_logos, $hero_post_id);
    
    // Trial Section
    update_field('trial_title', 'Jak działa darmowy plan Starter?', $hero_post_id);
    update_field('trial_subtitle', 'Rozpocznij bez ryzyka i przekonaj się, jak DogInvoice zmieni Twój sposób pracy.', $hero_post_id);
    $trial_steps = array(
        array(
            'icon' => 'file-text',
            'title' => 'Wypełniasz formularz',
            'description' => 'Prosty formularz rejestracyjny - zajmuje tylko 1 minutę.'
        ),
        array(
            'icon' => 'zap',
            'title' => 'Otrzymujesz dostęp',
            'description' => '10 darmowych dokumentów do przetworzenia miesięcznie - bez zobowiązań.'
        ),
        array(
            'icon' => 'calendar',
            'title' => 'Umawiasz prezentację',
            'description' => 'Darmowa prezentacja produktu z wyjaśnieniem wszystkich funkcjonalności.'
        )
    );
    update_field('trial_steps', $trial_steps, $hero_post_id);
    
    // CTA Section
    update_field('cta_title', 'Zacznij już dziś', $hero_post_id);
    update_field('cta_subtitle', 'Dołącz do firm, które oszczędzają 15 godzin tygodniowo dzięki automatyzacji.', $hero_post_id);
    update_field('cta_primary_text', 'Wybierz swój plan', $hero_post_id);
    update_field('cta_primary_url', '#pricing', $hero_post_id);
    update_field('cta_secondary_text', 'Przetestuj za darmo', $hero_post_id);
    update_field('cta_secondary_url', '/trial', $hero_post_id);
    
    echo '<p>✓ Hero section imported successfully</p>';
} else {
    echo '<p>✗ Failed to import hero section</p>';
}

// Import Features
echo '<h2>Importing Features...</h2>';
$features_data = array(
    array(
        'title' => 'Automatyzacja i integracja z AI',
        'description' => 'Faktury przychodzące mailem lub przez dedykowany portal są automatycznie przetwarzane przez algorytm AI, który między innymi wykrywa kategorię wydatku.',
        'video_url' => '/videos/aiautomation.mp4',
        'poster' => '/cover_1.png',
        'icon' => '🤖'
    ),
    array(
        'title' => 'Obsługa trudnych przypadków',
        'description' => 'Jeśli zdjęcie faktury jest nieczytelne lub niewyraźne, automatycznie korzystamy z autorskiej technologii AI OCR, aby zapewnić poprawne odczytanie wszystkich informacji.',
        'video_url' => '/videos/realtime.mp4',
        'poster' => '/cover_2.png',
        'icon' => '📈'
    ),
    array(
        'title' => 'Analiza finansowa',
        'description' => 'Na bieżąco monitoruj koszty i przychody dzięki intuicyjnym zestawieniom i wykresom. Komplet dokumentów można później łatwo wysłać do księgowej.',
        'video_url' => '/videos/integration.mp4',
        'poster' => '/cover_3.png',
        'icon' => '⚙️'
    )
);

foreach ($features_data as $index => $feature) {
    $post_id = wp_insert_post(array(
        'post_title' => $feature['title'],
        'post_content' => '',
        'post_status' => 'publish',
        'post_type' => 'dog_features',
        'post_author' => 1,
        'menu_order' => $index + 1,
    ));
    
    if ($post_id) {
        update_field('feature_title', $feature['title'], $post_id);
        update_field('feature_description', $feature['description'], $post_id);
        update_field('feature_video_url', $feature['video_url'], $post_id);
        update_field('feature_poster', $feature['poster'], $post_id);
        update_field('feature_icon', $feature['icon'], $post_id);
        echo '<p>✓ Feature "' . $feature['title'] . '" imported</p>';
    } else {
        echo '<p>✗ Failed to import feature "' . $feature['title'] . '"</p>';
    }
}

// Import Benefits
echo '<h2>Importing Benefits...</h2>';
$benefits_data = array(
    array(
        'title' => 'Pełna automatyzacja',
        'description' => 'Faktury przychodzące mailem lub przez formularz są automatycznie przetwarzane przez specjalny algorytm AI.',
        'highlight' => 'AI-powered',
        'icon' => '🤖'
    ),
    array(
        'title' => 'Obsługa trudnych przypadków',
        'description' => 'Nieczytelne faktury są automatycznie przekazywane do systemu OCR w celu poprawnego odczytania danych.',
        'highlight' => 'Smart OCR',
        'icon' => '📊'
    ),
    array(
        'title' => 'Automatyczna konwersja walut',
        'description' => 'System przelicza faktury w walutach obcych według aktualnych kursów.',
        'highlight' => 'Multi-currency',
        'icon' => '💰'
    ),
    array(
        'title' => 'Inteligentna archiwizacja',
        'description' => 'Faktury są zapisywane na Dysku Google użytkownika w uporządkowanej strukturze folderów gotowych do udostępnienia księgowej.',
        'highlight' => 'Google Drive',
        'icon' => '📁'
    ),
    array(
        'title' => 'Bilans w czasie rzeczywistym',
        'description' => 'Wszystkie dane są natychmiast widoczne w dashboardzie, dając Ci pełny wgląd w koszty i przychody.',
        'highlight' => 'Real-time',
        'icon' => '📈'
    ),
    array(
        'title' => 'Automatyczna kategoryzacja',
        'description' => 'Automatyczne rozpoznawanie oraz przypisywanie odpowiednich kategorii kosztów i przychodów.',
        'highlight' => 'Auto-categorize',
        'icon' => '🏷️'
    )
);

foreach ($benefits_data as $index => $benefit) {
    $post_id = wp_insert_post(array(
        'post_title' => $benefit['title'],
        'post_content' => '',
        'post_status' => 'publish',
        'post_type' => 'dog_benefits',
        'post_author' => 1,
        'menu_order' => $index + 1,
    ));
    
    if ($post_id) {
        update_field('benefit_title', $benefit['title'], $post_id);
        update_field('benefit_description', $benefit['description'], $post_id);
        update_field('benefit_highlight', $benefit['highlight'], $post_id);
        update_field('benefit_icon', $benefit['icon'], $post_id);
        echo '<p>✓ Benefit "' . $benefit['title'] . '" imported</p>';
    } else {
        echo '<p>✗ Failed to import benefit "' . $benefit['title'] . '"</p>';
    }
}

// Import Process Steps
echo '<h2>Importing Process Steps...</h2>';
$process_data = array(
    array(
        'title' => 'Wielokanałowy odbiór',
        'description' => 'Faktury przychodzące dowolną drogą są automatycznie identyfikowane w systemie.',
        'video_url' => '/videos/send_instruction.mp4',
        'icon' => '📤'
    ),
    array(
        'title' => 'Inteligentna weryfikacja',
        'description' => 'System sprawdza czy dokumenty to faktury oraz weryfikuje kontrahentów w bazie GUS.',
        'video_url' => '/videos/gus.mp4',
        'icon' => '✅'
    ),
    array(
        'title' => 'Analiza AI',
        'description' => 'Zaawansowany algorytm ekstrahuje takie dane jak kwoty, kontrahenci, rodzaje kosztów.',
        'video_url' => '/videos/automation.mp4',
        'icon' => '🧠'
    ),
    array(
        'title' => 'Automatyczna archiwizacja',
        'description' => 'Faktury są zapisywane w uporządkowanej strukturze na Twoim Dysku Google.',
        'video_url' => '/videos/google_drive.mp4',
        'icon' => '📁'
    ),
    array(
        'title' => 'Dashboard finansowy',
        'description' => 'Wszystkie dane są natychmiast widoczne na przejrzystych dashboardach analitycznych.',
        'video_url' => '/videos/analytics.mp4',
        'icon' => '📊'
    )
);

foreach ($process_data as $index => $process) {
    $post_id = wp_insert_post(array(
        'post_title' => $process['title'],
        'post_content' => '',
        'post_status' => 'publish',
        'post_type' => 'dog_process',
        'post_author' => 1,
        'menu_order' => $index + 1,
    ));
    
    if ($post_id) {
        update_field('process_title', $process['title'], $post_id);
        update_field('process_description', $process['description'], $post_id);
        update_field('process_video_url', $process['video_url'], $post_id);
        update_field('process_icon', $process['icon'], $post_id);
        echo '<p>✓ Process step "' . $process['title'] . '" imported</p>';
    } else {
        echo '<p>✗ Failed to import process step "' . $process['title'] . '"</p>';
    }
}

// Import Pricing Plans
echo '<h2>Importing Pricing Plans...</h2>';
$pricing_data = array(
    array(
        'name' => 'Starter',
        'description' => 'Na dobry początek.',
        'price' => 0,
        'invoices' => '10 faktur miesięcznie.',
        'button_text' => 'Rozpocznij za darmo',
        'button_url' => '/trial?plan=starter&billing=monthly',
        'is_popular' => false
    ),
    array(
        'name' => 'Professional',
        'description' => 'Dla rozwijających się firm.',
        'price' => 149,
        'invoices' => '150 faktur miesięcznie.',
        'button_text' => 'Wybierz plan',
        'button_url' => '/trial?plan=professional&billing=monthly',
        'is_popular' => true
    ),
    array(
        'name' => 'Business',
        'description' => 'Dla dużych organizacji.',
        'price' => 299,
        'invoices' => '500 faktur miesięcznie.',
        'button_text' => 'Wybierz plan',
        'button_url' => '/trial?plan=business&billing=monthly',
        'is_popular' => false
    ),
    array(
        'name' => 'Enterprise',
        'description' => 'Dla tych, którzy potrzebują więcej',
        'price' => null,
        'invoices' => 'Niestandardowe rozwiązania.',
        'button_text' => 'Wybierz plan',
        'button_url' => '/trial?plan=enterprise&billing=monthly',
        'is_popular' => false
    )
);

foreach ($pricing_data as $index => $pricing) {
    $post_id = wp_insert_post(array(
        'post_title' => $pricing['name'],
        'post_content' => '',
        'post_status' => 'publish',
        'post_type' => 'dog_pricing',
        'post_author' => 1,
        'menu_order' => $index + 1,
    ));
    
    if ($post_id) {
        update_field('pricing_name', $pricing['name'], $post_id);
        update_field('pricing_description', $pricing['description'], $post_id);
        update_field('pricing_price', $pricing['price'], $post_id);
        update_field('pricing_invoices', $pricing['invoices'], $post_id);
        update_field('pricing_button_text', $pricing['button_text'], $post_id);
        update_field('pricing_button_url', $pricing['button_url'], $post_id);
        update_field('pricing_is_popular', $pricing['is_popular'], $post_id);
        echo '<p>✓ Pricing plan "' . $pricing['name'] . '" imported</p>';
    } else {
        echo '<p>✗ Failed to import pricing plan "' . $pricing['name'] . '"</p>';
    }
}

// Import Integrations
echo '<h2>Importing Integrations...</h2>';
$integrations_data = array(
    array(
        'title' => 'SMTP/IMAP',
        'logo' => '/assets/smtp_imap_icon.svg',
        'coming_soon' => false
    ),
    array(
        'title' => 'Gmail',
        'logo' => '/assets/logo_gmail.svg',
        'coming_soon' => false
    ),
    array(
        'title' => 'Google Drive',
        'logo' => '/assets/google_drive_logo.svg',
        'coming_soon' => false
    ),
    array(
        'title' => 'GUS',
        'logo' => '/assets/gus_logo.svg',
        'coming_soon' => false
    ),
    array(
        'title' => 'Comarch Optima',
        'logo' => '/assets/optima_logo.svg',
        'coming_soon' => false
    ),
    array(
        'title' => 'Fakturownia',
        'logo' => '/assets/fakturownia_logo.svg',
        'coming_soon' => false
    ),
    array(
        'title' => 'Saldeo',
        'logo' => '/assets/saldeo_logo.svg',
        'coming_soon' => true
    ),
    array(
        'title' => 'KSeF',
        'logo' => '/assets/ksef_logo.svg',
        'coming_soon' => true
    )
);

foreach ($integrations_data as $index => $integration) {
    $post_id = wp_insert_post(array(
        'post_title' => $integration['title'],
        'post_content' => '',
        'post_status' => 'publish',
        'post_type' => 'dog_integrations',
        'post_author' => 1,
        'menu_order' => $index + 1,
    ));
    
    if ($post_id) {
        update_field('integration_title', $integration['title'], $post_id);
        update_field('integration_logo', $integration['logo'], $post_id);
        update_field('integration_coming_soon', $integration['coming_soon'], $post_id);
        echo '<p>✓ Integration "' . $integration['title'] . '" imported</p>';
    } else {
        echo '<p>✗ Failed to import integration "' . $integration['title'] . '"</p>';
    }
}

// Import FAQ
echo '<h2>Importing FAQ...</h2>';
$faq_data = array(
    array(
        'question' => 'Jak zabezpieczane są moje dane finansowe?',
        'answer' => 'DogInvoice działa w oparciu o najwyższe standardy bezpieczeństwa. Twoje dane są szyfrowane i przechowywane zgodnie z regulacjami RODO. Używamy tylko zaufanych dostawców chmury i regularnie przeprowadzamy audyty bezpieczeństwa.'
    ),
    array(
        'question' => 'Czy system można połączyć z moim oprogramowaniem księgowym?',
        'answer' => 'Tak, DogInvoice oferuje integracje z popularnymi systemami księgowymi. Możemy również stworzyć dedykowaną integrację dla Twojego systemu.'
    ),
    array(
        'question' => 'Ile trwa wdrożenie systemu?',
        'answer' => 'Standardowe wdrożenie trwa 2-3 dni robocze, włączając szkolenie pracowników. W przypadku bardziej złożonych konfiguracji może to potrwać do 5 dni.'
    ),
    array(
        'question' => 'Czy mogę dostosować system do nietypowych potrzeb?',
        'answer' => 'Oferujemy personalizację kategorii kosztów, przepływu pracy i raportów, aby idealnie dopasować system do Twojej działalności.'
    ),
    array(
        'question' => 'Czy system obsługuje faktury w różnych językach?',
        'answer' => 'Tak, DogInvoice obsługuje faktury w większości języków.'
    )
);

foreach ($faq_data as $index => $faq) {
    $post_id = wp_insert_post(array(
        'post_title' => $faq['question'],
        'post_content' => '',
        'post_status' => 'publish',
        'post_type' => 'dog_faq',
        'post_author' => 1,
        'menu_order' => $index + 1,
    ));
    
    if ($post_id) {
        update_field('faq_question', $faq['question'], $post_id);
        update_field('faq_answer', $faq['answer'], $post_id);
        echo '<p>✓ FAQ "' . $faq['question'] . '" imported</p>';
    } else {
        echo '<p>✗ Failed to import FAQ "' . $faq['question'] . '"</p>';
    }
}

echo '<h2>Import Complete!</h2>';
echo '<p>All content has been successfully imported from the Next.js application.</p>';
echo '<p><a href="' . home_url() . '" class="button button-primary">View Website</a></p>';
echo '<p><a href="' . admin_url() . '" class="button">Go to Admin</a></p>';
?>