<?php
/**
 * Create sample data directly
 */

// Load WordPress
require_once('../../../wp-load.php');

// Create Hero post
$hero_post = wp_insert_post(array(
    'post_title' => 'Hero Section',
    'post_type' => 'dog_hero',
    'post_status' => 'publish',
    'post_content' => 'Main hero section content'
));

if ($hero_post) {
    // Add ACF fields for hero
    update_field('hero_title', 'Robisz zdjęcie faktury, a reszta dzieje się automatycznie', $hero_post);
    update_field('hero_subtitle', 'DogInvoice automatycznie organizuje Twoje dokumenty, eliminuje chaos administracyjny i pozwala Ci skupić się na tym, co naprawdę ważne.', $hero_post);
    update_field('hero_cta_primary_text', 'Wybierz swój plan', $hero_post);
    update_field('hero_cta_primary_url', '#pricing', $hero_post);
    update_field('hero_cta_secondary_text', 'Przetestuj za darmo', $hero_post);
    update_field('hero_cta_secondary_url', '/trial', $hero_post);
    
    // Animated numbers
    $animated_numbers = array(
        array(
            'value' => '50,000',
            'suffix' => '+',
            'title' => 'Przetworzonych faktur',
            'description' => 'przez naszych klientów',
            'color' => 'text-primary'
        ),
        array(
            'value' => '15',
            'suffix' => 'h',
            'title' => 'Oszczędności tygodniowo',
            'description' => 'średnio na każdego użytkownika',
            'color' => 'text-orange-500'
        ),
        array(
            'value' => '99',
            'suffix' => '%',
            'title' => 'Dokładność AI',
            'description' => 'w rozpoznawaniu danych z faktur',
            'color' => 'text-primary'
        )
    );
    update_field('animated_numbers', $animated_numbers, $hero_post);
    
    echo "Hero post created with ID: $hero_post\n";
}

// Create Features posts
$features_data = array(
    array(
        'title' => 'Automatyzacja i integracja z AI',
        'description' => 'Faktury przychodzące mailem lub przez dedykowany portal są automatycznie przetwarzane przez algorytm AI, który między innymi wykrywa kategorię wydatku.',
        'icon' => '🤖'
    ),
    array(
        'title' => 'Obsługa trudnych przypadków',
        'description' => 'Jeśli zdjęcie faktury jest nieczytelne lub niewyraźne, automatycznie korzystamy z autorskiej technologii AI OCR, aby zapewnić poprawne odczytanie wszystkich informacji.',
        'icon' => '🔍'
    ),
    array(
        'title' => 'Analiza finansowa',
        'description' => 'Na bieżąco monitoruj koszty i przychody dzięki intuicyjnym zestawieniom i wykresom. Komplet dokumentów można później łatwo wysłać do księgowej.',
        'icon' => '📊'
    )
);

foreach ($features_data as $index => $feature) {
    $feature_post = wp_insert_post(array(
        'post_title' => $feature['title'],
        'post_type' => 'dog_features',
        'post_status' => 'publish',
        'menu_order' => $index + 1
    ));
    
    if ($feature_post) {
        update_field('feature_title', $feature['title'], $feature_post);
        update_field('feature_description', $feature['description'], $feature_post);
        update_field('feature_icon', $feature['icon'], $feature_post);
        echo "Feature post created: {$feature['title']}\n";
    }
}

// Create Pricing posts
$pricing_data = array(
    array(
        'name' => 'Starter',
        'description' => 'Na dobry początek.',
        'price' => '0',
        'invoices' => '10 faktur miesięcznie.',
        'button_text' => 'Rozpocznij za darmo',
        'button_url' => '/trial?plan=starter&billing=monthly',
        'is_popular' => false
    ),
    array(
        'name' => 'Professional',
        'description' => 'Dla rozwijających się firm.',
        'price' => '149',
        'invoices' => '150 faktur miesięcznie.',
        'button_text' => 'Wybierz plan',
        'button_url' => '/trial?plan=professional&billing=monthly',
        'is_popular' => true
    ),
    array(
        'name' => 'Business',
        'description' => 'Dla dużych organizacji.',
        'price' => '299',
        'invoices' => '500 faktur miesięcznie.',
        'button_text' => 'Wybierz plan',
        'button_url' => '/trial?plan=business&billing=monthly',
        'is_popular' => false
    ),
    array(
        'name' => 'Enterprise',
        'description' => 'Dla tych, którzy potrzebują więcej',
        'price' => '',
        'invoices' => 'Niestandardowe rozwiązania.',
        'button_text' => 'Wybierz plan',
        'button_url' => '/trial?plan=enterprise&billing=monthly',
        'is_popular' => false
    )
);

foreach ($pricing_data as $index => $pricing) {
    $pricing_post = wp_insert_post(array(
        'post_title' => $pricing['name'],
        'post_type' => 'dog_pricing',
        'post_status' => 'publish',
        'menu_order' => $index + 1
    ));
    
    if ($pricing_post) {
        update_field('pricing_name', $pricing['name'], $pricing_post);
        update_field('pricing_description', $pricing['description'], $pricing_post);
        update_field('pricing_price', $pricing['price'], $pricing_post);
        update_field('pricing_invoices', $pricing['invoices'], $pricing_post);
        update_field('pricing_button_text', $pricing['button_text'], $pricing_post);
        update_field('pricing_button_url', $pricing['button_url'], $pricing_post);
        update_field('pricing_is_popular', $pricing['is_popular'], $pricing_post);
        echo "Pricing post created: {$pricing['name']}\n";
    }
}

// Create Benefits posts
$benefits_data = array(
    array(
        'title' => 'Automatyczne kategoryzowanie',
        'description' => 'AI automatycznie przypisuje faktury do odpowiednich kategorii księgowych, oszczędzając godziny ręcznej pracy.',
        'highlight' => 'AI',
        'icon' => '🤖'
    ),
    array(
        'title' => 'Integracja z systemami',
        'description' => 'Łatwe połączenie z popularnymi systemami księgowymi i ERP.',
        'highlight' => 'Integracje',
        'icon' => '🔗'
    ),
    array(
        'title' => 'Raportowanie w czasie rzeczywistym',
        'description' => 'Natychmiastowy dostęp do analiz i raportów finansowych.',
        'highlight' => 'Raporty',
        'icon' => '📊'
    )
);

foreach ($benefits_data as $index => $benefit) {
    $benefit_post = wp_insert_post(array(
        'post_title' => $benefit['title'],
        'post_type' => 'dog_benefits',
        'post_status' => 'publish',
        'menu_order' => $index + 1
    ));
    
    if ($benefit_post) {
        update_field('benefit_title', $benefit['title'], $benefit_post);
        update_field('benefit_description', $benefit['description'], $benefit_post);
        update_field('benefit_highlight', $benefit['highlight'], $benefit_post);
        update_field('benefit_icon', $benefit['icon'], $benefit_post);
        echo "Benefit post created: {$benefit['title']}\n";
    }
}

// Create Process posts
$process_data = array(
    array(
        'title' => 'Zrób zdjęcie faktury',
        'description' => 'Wystarczy zrobić zdjęcie faktury telefonem lub przesłać plik PDF.',
        'icon' => '📸'
    ),
    array(
        'title' => 'AI przetwarza dokument',
        'description' => 'Nasza sztuczna inteligencja automatycznie odczytuje wszystkie dane z faktury.',
        'icon' => '🧠'
    ),
    array(
        'title' => 'Gotowe dane w systemie',
        'description' => 'Dane są automatycznie wprowadzane do Twojego systemu księgowego.',
        'icon' => '✅'
    )
);

foreach ($process_data as $index => $process) {
    $process_post = wp_insert_post(array(
        'post_title' => $process['title'],
        'post_type' => 'dog_process',
        'post_status' => 'publish',
        'menu_order' => $index + 1
    ));
    
    if ($process_post) {
        update_field('process_title', $process['title'], $process_post);
        update_field('process_description', $process['description'], $process_post);
        update_field('process_icon', $process['icon'], $process_post);
        echo "Process post created: {$process['title']}\n";
    }
}

// Create Integrations posts
$integrations_data = array(
    array(
        'title' => 'Comarch ERP',
        'logo' => '/wp-content/themes/doginvoice/assets/images/comarch-logo.png',
        'coming_soon' => false
    ),
    array(
        'title' => 'SMTP/IMAP',
        'logo' => '/wp-content/themes/doginvoice/assets/images/smtp-logo.png',
        'coming_soon' => false
    ),
    array(
        'title' => 'Integracja w przygotowaniu',
        'logo' => '/wp-content/themes/doginvoice/assets/images/coming-soon.png',
        'coming_soon' => true
    )
);

foreach ($integrations_data as $index => $integration) {
    $integration_post = wp_insert_post(array(
        'post_title' => $integration['title'],
        'post_type' => 'dog_integrations',
        'post_status' => 'publish',
        'menu_order' => $index + 1
    ));
    
    if ($integration_post) {
        update_field('integration_title', $integration['title'], $integration_post);
        update_field('integration_logo', $integration['logo'], $integration_post);
        update_field('integration_coming_soon', $integration['coming_soon'], $integration_post);
        echo "Integration post created: {$integration['title']}\n";
    }
}

// Create FAQ posts
$faq_data = array(
    array(
        'question' => 'Jak dokładne jest rozpoznawanie faktur?',
        'answer' => 'Nasze AI osiąga 99% dokładności w rozpoznawaniu danych z faktur. W przypadku wątpliwości, system automatycznie oznacza dane do weryfikacji.'
    ),
    array(
        'question' => 'Czy mogę integrować z moim systemem księgowym?',
        'answer' => 'Tak, DogInvoice oferuje integracje z popularnymi systemami księgowymi i ERP. Skontaktuj się z nami, aby omówić szczegóły integracji.'
    ),
    array(
        'question' => 'Jak długo trwa wdrożenie?',
        'answer' => 'Podstawowe wdrożenie trwa zwykle 1-2 tygodnie. W przypadku niestandardowych integracji czas może być dłuższy.'
    )
);

foreach ($faq_data as $index => $faq) {
    $faq_post = wp_insert_post(array(
        'post_title' => $faq['question'],
        'post_type' => 'dog_faq',
        'post_status' => 'publish',
        'menu_order' => $index + 1
    ));
    
    if ($faq_post) {
        update_field('faq_question', $faq['question'], $faq_post);
        update_field('faq_answer', $faq['answer'], $faq_post);
        echo "FAQ post created: {$faq['question']}\n";
    }
}

echo "Sample data creation completed!\n";
?>
