<?php
/**
 * Skrypt do dodania danych FAQ do WordPress
 * Uruchom ten skrypt w przeglądarce: http://localhost:8080/wp-content/themes/dog-invoice-wordpress-theme/add-faq-data.php
 */

// Załaduj WordPress
require_once('../../../wp-load.php');

// Sprawdź czy użytkownik jest zalogowany jako administrator
if (!current_user_can('manage_options')) {
    die('Brak uprawnień administratora');
}

// Pobierz aktualne dane
$content = get_option('doginvoice_content', array());

// Jeśli dane są w formacie string, deserializuj
if (is_string($content)) {
    $content = maybe_unserialize($content);
}

// Dodaj nowe pytania FAQ
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

// Zastąp istniejące FAQ nowymi
$content['faq'] = $new_faqs;

// Zapisz dane
$result = update_option('doginvoice_content', $content);

if ($result) {
    echo '<h1>✅ FAQ zostały pomyślnie dodane!</h1>';
    echo '<p>Dodano ' . count($new_faqs) . ' pytań FAQ.</p>';
    echo '<h2>Dodane pytania:</h2>';
    echo '<ul>';
    foreach ($new_faqs as $faq) {
        echo '<li><strong>' . esc_html($faq['faq_question']) . '</strong></li>';
    }
    echo '</ul>';
    echo '<p><a href="/wp-admin/admin.php?page=doginvoice-content&tab=faq">Przejdź do edycji FAQ w WordPress Admin</a></p>';
} else {
    echo '<h1>❌ Błąd podczas zapisywania FAQ</h1>';
}

// Wyświetl aktualne dane FAQ
echo '<h2>Aktualne dane FAQ w bazie:</h2>';
echo '<pre>';
print_r($content['faq'] ?? 'Brak danych FAQ');
echo '</pre>';
?>

