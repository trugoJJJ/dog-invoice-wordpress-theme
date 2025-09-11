<?php
/**
 * Data Import Script for DogInvoice WordPress Theme
 * Run this script to import sample data
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

function doginvoice_import_sample_data() {
    // Check if user has permission
    if (!current_user_can('manage_options')) {
        wp_die('You do not have permission to run this script.');
    }
    
    echo '<h1>Importing DogInvoice Sample Data...</h1>';
    
    // Import Hero Section
    import_hero_data();
    
    // Import Process Steps
    import_process_steps();
    
    // Import Features
    import_features();
    
    // Import Integrations
    import_integrations();
    
    // Import Benefits
    import_benefits();
    
    // Import FAQ
    import_faq();
    
    // Import Pricing Plans
    import_pricing_plans();
    
    echo '<h2>✅ Sample data imported successfully!</h2>';
    echo '<p><a href="' . admin_url() . '">Go to WordPress Admin</a></p>';
}

function import_hero_data() {
    echo '<h3>Importing Hero Section...</h3>';
    
    $hero_data = array(
        'post_title' => 'Hero Section',
        'post_content' => '',
        'post_status' => 'publish',
        'post_type' => 'doginvoice_hero',
        'post_author' => 1
    );
    
    $hero_id = wp_insert_post($hero_data);
    
    if ($hero_id) {
        update_field('hero_title', 'Robisz zdjęcie faktury, a reszta dzieje się automatycznie', $hero_id);
        update_field('hero_subtitle', 'DogInvoice automatycznie organizuje Twoje dokumenty, eliminuje chaos administracyjny i pozwala Ci skupić się na tym, co naprawdę ważne.', $hero_id);
        update_field('hero_description', 'Zaawansowany system AI do automatycznego zarządzania fakturami i dokumentami finansowymi.', $hero_id);
        update_field('hero_video_url', '/videos/doginvoice_hero.mp4', $hero_id);
        update_field('hero_video_poster', '/doginvoice_hero_frame.png', $hero_id);
        update_field('hero_cta_primary_text', 'Wybierz swój plan', $hero_id);
        update_field('hero_cta_primary_url', '#pricing', $hero_id);
        update_field('hero_cta_secondary_text', 'Przetestuj za darmo', $hero_id);
        update_field('hero_cta_secondary_url', '/trial', $hero_id);
        
        echo '<p>✅ Hero section imported (ID: ' . $hero_id . ')</p>';
    } else {
        echo '<p>❌ Failed to import hero section</p>';
    }
}

function import_process_steps() {
    echo '<h3>Importing Process Steps...</h3>';
    
    $steps_data = array(
        array(
            'title' => 'Wielokanałowy odbiór',
            'content' => 'Wysyłaj faktury przez email, SMS, WhatsApp lub bezpośrednio z aplikacji mobilnej. System automatycznie wykrywa i pobiera dokumenty z różnych źródeł.',
            'number' => '01',
            'icon' => 'upload',
            'position_x' => 20,
            'position_y' => 30,
            'video_url' => '/videos/step01.mp4'
        ),
        array(
            'title' => 'Weryfikacja dokumentów',
            'content' => 'System automatycznie weryfikuje poprawność danych, wykrywa błędy i sprawdza zgodność z wymogami prawnymi. Wszystkie dokumenty są walidowane przed dalszym przetwarzaniem.',
            'number' => '02',
            'icon' => 'check-circle',
            'position_x' => 40,
            'position_y' => 20,
            'video_url' => '/videos/step02.mp4'
        ),
        array(
            'title' => 'Analiza AI',
            'content' => 'Zaawansowane algorytmy AI analizują i kategoryzują dokumenty, wyciągają kluczowe dane i automatycznie przypisują je do odpowiednich kategorii finansowych.',
            'number' => '03',
            'icon' => 'brain',
            'position_x' => 60,
            'position_y' => 30,
            'video_url' => '/videos/step03.mp4'
        ),
        array(
            'title' => 'Archiwizacja',
            'content' => 'Dokumenty są automatycznie archiwizowane i indeksowane w bezpiecznym repozytorium. Możesz łatwo wyszukiwać i pobierać dokumenty z dowolnego okresu.',
            'number' => '04',
            'icon' => 'folder-open',
            'position_x' => 80,
            'position_y' => 20,
            'video_url' => '/videos/step04.mp4'
        ),
        array(
            'title' => 'Dashboard',
            'content' => 'Kompletny przegląd finansów w czasie rzeczywistym. Intuicyjne wykresy, raporty i analizy pomagają w podejmowaniu świadomych decyzji biznesowych.',
            'number' => '05',
            'icon' => 'bar-chart-3',
            'position_x' => 50,
            'position_y' => 50,
            'video_url' => '/videos/step05.mp4'
        )
    );
    
    foreach ($steps_data as $index => $step_data) {
        $post_data = array(
            'post_title' => $step_data['title'],
            'post_content' => $step_data['content'],
            'post_status' => 'publish',
            'post_type' => 'process_steps',
            'post_author' => 1,
            'menu_order' => $index + 1
        );
        
        $post_id = wp_insert_post($post_data);
        
        if ($post_id) {
            update_field('step_number', $step_data['number'], $post_id);
            update_field('step_icon', $step_data['icon'], $post_id);
            update_field('step_position_x', $step_data['position_x'], $post_id);
            update_field('step_position_y', $step_data['position_y'], $post_id);
            update_field('step_video_url', $step_data['video_url'], $post_id);
            
            echo '<p>✅ Step ' . $step_data['number'] . ' imported (ID: ' . $post_id . ')</p>';
        } else {
            echo '<p>❌ Failed to import step ' . $step_data['number'] . '</p>';
        }
    }
}

function import_features() {
    echo '<h3>Importing Features...</h3>';
    
    $features_data = array(
        array(
            'title' => 'Automatyzacja procesów',
            'content' => 'Automatyczne kategoryzowanie i klasyfikacja dokumentów bez interwencji użytkownika. System uczy się z Twoich preferencji i dostosowuje się do Twojego stylu pracy.',
            'icon' => 'zap',
            'highlight' => 'Auto-categorize',
            'video_url' => '/videos/feature01.mp4'
        ),
        array(
            'title' => 'Analiza finansowa',
            'content' => 'Na bieżąco monitoruj koszty i przychody dzięki intuicyjnym zestawieniom i wykresom. Komplet dokumentów można później łatwo wysłać do księgowej.',
            'icon' => 'settings',
            'highlight' => 'Real-time',
            'video_url' => '/videos/feature02.mp4'
        ),
        array(
            'title' => 'Wzrost wydajności',
            'content' => 'Zwiększ wydajność swojego zespołu o 300% dzięki automatyzacji rutynowych zadań. Skup się na tym, co naprawdę ważne dla Twojego biznesu.',
            'icon' => 'trending-up',
            'highlight' => '+300%',
            'video_url' => '/videos/feature03.mp4'
        ),
        array(
            'title' => 'Bezpieczeństwo danych',
            'content' => 'Twoje dane są chronione najnowszymi standardami szyfrowania. Regularne backupy i monitoring bezpieczeństwa zapewniają pełną ochronę informacji.',
            'icon' => 'shield',
            'highlight' => 'Bank-level',
            'video_url' => '/videos/feature04.mp4'
        ),
        array(
            'title' => 'Czas rzeczywisty',
            'content' => 'Wszystkie dane są natychmiast widoczne w dashboardzie, dając Ci pełny wgląd w koszty i przychody. Nie czekaj na raporty - wszystko w czasie rzeczywistym.',
            'icon' => 'clock',
            'highlight' => 'Live updates',
            'video_url' => '/videos/feature05.mp4'
        )
    );
    
    foreach ($features_data as $index => $feature_data) {
        $post_data = array(
            'post_title' => $feature_data['title'],
            'post_content' => $feature_data['content'],
            'post_status' => 'publish',
            'post_type' => 'features',
            'post_author' => 1,
            'menu_order' => $index + 1
        );
        
        $post_id = wp_insert_post($post_data);
        
        if ($post_id) {
            update_field('feature_icon', $feature_data['icon'], $post_id);
            update_field('feature_highlight', $feature_data['highlight'], $post_id);
            update_field('feature_video_url', $feature_data['video_url'], $post_id);
            
            echo '<p>✅ Feature "' . $feature_data['title'] . '" imported (ID: ' . $post_id . ')</p>';
        } else {
            echo '<p>❌ Failed to import feature "' . $feature_data['title'] . '"</p>';
        }
    }
}

function import_integrations() {
    echo '<h3>Importing Integrations...</h3>';
    
    $integrations_data = array(
        array(
            'title' => 'KSeF',
            'content' => 'Integracja z Krajowym Systemem e-Faktur',
            'logo' => '/assets/images/ksef_logo.svg',
            'url' => 'https://ksef.gov.pl',
            'coming_soon' => false
        ),
        array(
            'title' => 'Fakturownia',
            'content' => 'Automatyczne pobieranie faktur z Fakturowni',
            'logo' => '/assets/images/fakturownia_logo.svg',
            'url' => 'https://fakturownia.pl',
            'coming_soon' => false
        ),
        array(
            'title' => 'Google Drive',
            'content' => 'Synchronizacja z Google Drive',
            'logo' => '/assets/images/google_drive_logo.svg',
            'url' => 'https://drive.google.com',
            'coming_soon' => false
        ),
        array(
            'title' => 'Gmail',
            'content' => 'Automatyczne pobieranie faktur z Gmail',
            'logo' => '/assets/images/logo_gmail.svg',
            'url' => 'https://gmail.com',
            'coming_soon' => false
        ),
        array(
            'title' => 'SMTP/IMAP',
            'content' => 'Integracja z serwerami email',
            'logo' => '/assets/images/smtp_imap_icon.svg',
            'url' => '#',
            'coming_soon' => false
        ),
        array(
            'title' => 'Comarch Optima',
            'content' => 'Integracja z systemem Comarch Optima',
            'logo' => '/assets/images/optima_logo.svg',
            'url' => 'https://optima.comarch.pl',
            'coming_soon' => false
        ),
        array(
            'title' => 'SALDeo',
            'content' => 'Integracja z systemem SALDeo',
            'logo' => '/assets/images/saldeo_logo.svg',
            'url' => 'https://saldeo.pl',
            'coming_soon' => true
        ),
        array(
            'title' => 'GUS',
            'content' => 'Integracja z systemem GUS',
            'logo' => '/assets/images/gus_logo.svg',
            'url' => 'https://gus.gov.pl',
            'coming_soon' => true
        )
    );
    
    foreach ($integrations_data as $index => $integration_data) {
        $post_data = array(
            'post_title' => $integration_data['title'],
            'post_content' => $integration_data['content'],
            'post_status' => 'publish',
            'post_type' => 'integrations',
            'post_author' => 1,
            'menu_order' => $index + 1
        );
        
        $post_id = wp_insert_post($post_data);
        
        if ($post_id) {
            update_field('integration_logo', $integration_data['logo'], $post_id);
            update_field('integration_url', $integration_data['url'], $post_id);
            update_field('integration_coming_soon', $integration_data['coming_soon'], $post_id);
            
            echo '<p>✅ Integration "' . $integration_data['title'] . '" imported (ID: ' . $post_id . ')</p>';
        } else {
            echo '<p>❌ Failed to import integration "' . $integration_data['title'] . '"</p>';
        }
    }
}

function import_benefits() {
    echo '<h3>Importing Benefits...</h3>';
    
    $benefits_data = array(
        array(
            'title' => 'Automatyzacja',
            'content' => 'Oszczędź 10 godzin tygodniowo dzięki automatyzacji rutynowych zadań. System pracuje 24/7, więc Ty możesz skupić się na rozwoju biznesu.',
            'icon' => 'bot',
            'highlight' => '10h/week'
        ),
        array(
            'title' => 'Bilans w czasie rzeczywistym',
            'content' => 'Wszystkie dane są natychmiast widoczne w dashboardzie, dając Ci pełny wgląd w koszty i przychody. Nie czekaj na raporty - wszystko w czasie rzeczywistym.',
            'icon' => 'trending-up',
            'highlight' => 'Real-time'
        ),
        array(
            'title' => 'Inteligentna kategoryzacja',
            'content' => 'AI automatycznie kategoryzuje dokumenty na podstawie treści, kwot i dostawców. Uczy się z Twoich preferencji i dostosowuje się do Twojego stylu pracy.',
            'icon' => 'tags',
            'highlight' => 'AI-powered'
        ),
        array(
            'title' => 'Bezpieczeństwo',
            'content' => 'Twoje dane są chronione najnowszymi standardami szyfrowania. Regularne backupy i monitoring bezpieczeństwa zapewniają pełną ochronę informacji.',
            'icon' => 'shield',
            'highlight' => 'Bank-level'
        ),
        array(
            'title' => 'Dostęp 24/7',
            'content' => 'Dostęp do dokumentów z dowolnego miejsca i o każdej porze. Aplikacja mobilna pozwala na zarządzanie fakturami w podróży.',
            'icon' => 'clock',
            'highlight' => '24/7'
        )
    );
    
    foreach ($benefits_data as $index => $benefit_data) {
        $post_data = array(
            'post_title' => $benefit_data['title'],
            'post_content' => $benefit_data['content'],
            'post_status' => 'publish',
            'post_type' => 'benefits',
            'post_author' => 1,
            'menu_order' => $index + 1
        );
        
        $post_id = wp_insert_post($post_data);
        
        if ($post_id) {
            update_field('benefit_icon', $benefit_data['icon'], $post_id);
            update_field('benefit_highlight', $benefit_data['highlight'], $post_id);
            
            echo '<p>✅ Benefit "' . $benefit_data['title'] . '" imported (ID: ' . $post_id . ')</p>';
        } else {
            echo '<p>❌ Failed to import benefit "' . $benefit_data['title'] . '"</p>';
        }
    }
}

function import_faq() {
    echo '<h3>Importing FAQ...</h3>';
    
    $faq_data = array(
        array(
            'question' => 'Jak działa automatyczne rozpoznawanie faktur?',
            'answer' => 'DogInvoice wykorzystuje zaawansowane algorytmy AI do automatycznego rozpoznawania i ekstrakcji danych z faktur. System analizuje strukturę dokumentu, identyfikuje kluczowe elementy jak numer faktury, data, kwota, NIP i automatycznie kategoryzuje dokumenty.'
        ),
        array(
            'question' => 'Czy moje dane są bezpieczne?',
            'answer' => 'Tak, bezpieczeństwo danych to nasz priorytet. Wszystkie dane są szyfrowane przy użyciu najnowszych standardów szyfrowania (AES-256). Regularnie wykonujemy backupy i monitorujemy system pod kątem bezpieczeństwa. Nasze serwery są zlokalizowane w Polsce i spełniają wymogi RODO.'
        ),
        array(
            'question' => 'Jakie integracje są dostępne?',
            'answer' => 'DogInvoice integruje się z najpopularniejszymi systemami księgowymi i narzędziami biznesowymi, w tym KSeF, Fakturownia, Google Drive, Gmail, Comarch Optima i wiele innych. Lista dostępnych integracji jest stale rozszerzana.'
        ),
        array(
            'question' => 'Czy mogę anulować subskrypcję?',
            'answer' => 'Tak, możesz anulować subskrypcję w dowolnym momencie. Anulowanie nie wiąże się z żadnymi opłatami. Twoje dane pozostaną dostępne przez 30 dni po anulowaniu, co pozwoli Ci na eksport wszystkich informacji.'
        ),
        array(
            'question' => 'Jak działa system backup?',
            'answer' => 'Wykonujemy automatyczne backupy danych codziennie. Wszystkie dane są przechowywane w wielu lokalizacjach geograficznych, co zapewnia maksymalną dostępność i bezpieczeństwo. W przypadku awarii możesz przywrócić dane z dowolnego punktu w czasie.'
        ),
        array(
            'question' => 'Czy DogInvoice działa na urządzeniach mobilnych?',
            'answer' => 'Tak, DogInvoice jest w pełni responsywny i działa na wszystkich urządzeniach mobilnych. Możesz zarządzać fakturami, przeglądać raporty i monitorować finanse z dowolnego miejsca za pomocą smartfona lub tabletu.'
        )
    );
    
    foreach ($faq_data as $index => $faq_item) {
        $post_data = array(
            'post_title' => $faq_item['question'],
            'post_content' => $faq_item['answer'],
            'post_status' => 'publish',
            'post_type' => 'faq',
            'post_author' => 1,
            'menu_order' => $index + 1
        );
        
        $post_id = wp_insert_post($post_data);
        
        if ($post_id) {
            echo '<p>✅ FAQ "' . $faq_item['question'] . '" imported (ID: ' . $post_id . ')</p>';
        } else {
            echo '<p>❌ Failed to import FAQ "' . $faq_item['question'] . '"</p>';
        }
    }
}

function import_pricing_plans() {
    echo '<h3>Importing Pricing Plans...</h3>';
    
    $plans_data = array(
        array(
            'title' => 'Basic',
            'content' => 'Idealny dla małych firm i freelancerów',
            'price' => '99',
            'period' => '/miesiąc',
            'features' => "100 faktur/miesiąc\nPodstawowe raporty\nEmail support\nIntegracja z 3 systemami\nBackup danych\nMobile app",
            'cta_text' => 'Rozpocznij',
            'cta_url' => '/trial',
            'popular' => false
        ),
        array(
            'title' => 'Pro',
            'content' => 'Najpopularniejszy plan dla rozwijających się firm',
            'price' => '199',
            'period' => '/miesiąc',
            'features' => "500 faktur/miesiąc\nZaawansowane raporty\nPriority support\nWszystkie integracje\nAPI access\nCustom branding\nAdvanced analytics",
            'cta_text' => 'Rozpocznij',
            'cta_url' => '/trial',
            'popular' => true
        ),
        array(
            'title' => 'Enterprise',
            'content' => 'Dla dużych firm z zaawansowanymi wymaganiami',
            'price' => 'Kontakt',
            'period' => '',
            'features' => "Nielimitowane faktury\nCustom integrations\nDedicated support\nSLA 99.9%\nOn-premise deployment\nCustom development\nWhite-label solution",
            'cta_text' => 'Skontaktuj się',
            'cta_url' => '/contact',
            'popular' => false
        )
    );
    
    foreach ($plans_data as $index => $plan_data) {
        $post_data = array(
            'post_title' => $plan_data['title'],
            'post_content' => $plan_data['content'],
            'post_status' => 'publish',
            'post_type' => 'pricing_plans',
            'post_author' => 1,
            'menu_order' => $index + 1
        );
        
        $post_id = wp_insert_post($post_data);
        
        if ($post_id) {
            update_field('plan_price', $plan_data['price'], $post_id);
            update_field('plan_period', $plan_data['period'], $post_id);
            update_field('plan_features', $plan_data['features'], $post_id);
            update_field('plan_cta_text', $plan_data['cta_text'], $post_id);
            update_field('plan_cta_url', $plan_data['cta_url'], $post_id);
            update_field('plan_popular', $plan_data['popular'], $post_id);
            
            echo '<p>✅ Plan "' . $plan_data['title'] . '" imported (ID: ' . $post_id . ')</p>';
        } else {
            echo '<p>❌ Failed to import plan "' . $plan_data['title'] . '"</p>';
        }
    }
}

// Run the import if accessed directly
if (isset($_GET['run_import']) && $_GET['run_import'] === 'true') {
    doginvoice_import_sample_data();
}
?>
