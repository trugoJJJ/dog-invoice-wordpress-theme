<?php
/**
 * Skrypt do aktualizacji danych FAQ
 * Uruchom: php update-faq.php
 */

// Załaduj WordPress
require_once('../../../wp-load.php');

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
    echo "✅ FAQ zostały pomyślnie dodane!\n";
    echo "Dodano " . count($new_faqs) . " pytań FAQ.\n";
    echo "\nDodane pytania:\n";
    foreach ($new_faqs as $i => $faq) {
        echo ($i + 1) . ". " . $faq['faq_question'] . "\n";
    }
} else {
    echo "❌ Błąd podczas zapisywania FAQ\n";
}

// Wyświetl aktualne dane FAQ
echo "\nAktualne dane FAQ w bazie:\n";
print_r($content['faq'] ?? 'Brak danych FAQ');
?>

