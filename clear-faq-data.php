<?php
/**
 * Skrypt do usunięcia starych danych FAQ
 * Uruchom w przeglądarce: http://localhost:8080/wp-content/themes/dog-invoice-wordpress-theme/clear-faq-data.php
 */

// Załaduj WordPress
require_once('../../../wp-load.php');

// Sprawdź czy użytkownik jest zalogowany
if (!is_user_logged_in()) {
    echo '<h1>❌ Musisz być zalogowany do WordPress</h1>';
    echo '<p><a href="/wp-admin/">Zaloguj się do WordPress Admin</a></p>';
    exit;
}

// Pobierz aktualne dane
$content = get_option('doginvoice_content', array());

// Jeśli dane są w formacie string, deserializuj
if (is_string($content)) {
    $content = maybe_unserialize($content);
}

echo '<h1>🧹 Czyszczenie starych danych FAQ</h1>';

// Wyświetl aktualne dane FAQ
echo '<h2>Aktualne dane FAQ w bazie:</h2>';
echo '<pre>';
print_r($content['faq'] ?? 'Brak danych FAQ');
echo '</pre>';

// Usuń stare dane FAQ
unset($content['faq']);

// Zapisz dane
$result = update_option('doginvoice_content', $content);

if ($result) {
    echo '<h2>✅ Stare dane FAQ zostały usunięte!</h2>';
    echo '<p>Teraz endpoint FAQ będzie używał domyślnych wartości z kodu.</p>';
} else {
    echo '<h2>❌ Błąd podczas usuwania danych FAQ</h2>';
}

// Test API endpoint
echo '<h2>Test API endpoint:</h2>';
echo '<p><a href="/wp-json/doginvoice/v1/faq" target="_blank">Sprawdź endpoint FAQ API</a></p>';

// Wyświetl nowe dane FAQ
echo '<h2>Nowe dane FAQ (domyślne):</h2>';
$new_faqs = array(
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

echo '<ol>';
foreach ($new_faqs as $i => $faq) {
    echo '<li><strong>' . esc_html($faq['faq_question']) . '</strong><br>';
    echo '<em>' . esc_html($faq['faq_answer']) . '</em></li><br>';
}
echo '</ol>';
?>

