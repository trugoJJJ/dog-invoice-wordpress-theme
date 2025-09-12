<?php
/**
 * Unified Admin Interface for DogInvoice
 * Works with ACF Free - creates single admin page
 */

// Add admin menu
function doginvoice_add_admin_menu() {
    add_menu_page(
        'DogInvoice Content',
        'DogInvoice Content',
        'manage_options',
        'doginvoice-content',
        'doginvoice_admin_page',
        'dashicons-admin-home',
        2
    );
}
add_action('admin_menu', 'doginvoice_add_admin_menu');

// Admin page callback
function doginvoice_admin_page() {
    // Handle form submission
    if (isset($_POST['submit']) && wp_verify_nonce($_POST['doginvoice_nonce'], 'doginvoice_save')) {
        $section = sanitize_text_field($_POST['section'] ?? '');
        doginvoice_save_section($section);
        echo '<div class="notice notice-success"><p>Treść sekcji "' . esc_html($section) . '" została zapisana!</p></div>';
    }
    
    // Get current values
    $content = get_option('doginvoice_content', array());
    
    ?>
    <div class="wrap">
        <h1>🎯 DogInvoice - Edycja treści strony</h1>
        <p>Edytuj wszystkie treści strony w jednym miejscu</p>
        
        <div id="doginvoice-tabs">
                <nav class="nav-tab-wrapper">
                    <!-- Sekcje strony głównej w kolejności od góry do dołu -->
                    <a href="#hero" class="nav-tab nav-tab-active">🎯 Hero Section</a>
                    <a href="#numbers" class="nav-tab">📊 Liczby animowane</a>
                    <a href="#features" class="nav-tab">💡 Korzyści</a>
                    <a href="#benefits" class="nav-tab">⚡ Funkcjonalności</a>
                    <a href="#process" class="nav-tab">🔄 Kroki procesu</a>
                    <a href="#pricing" class="nav-tab">💰 Plany cenowe</a>
                    <a href="#integrations" class="nav-tab">🔗 Integracje</a>
                    <a href="#cta" class="nav-tab">📢 CTA Section</a>
                    <a href="#faq" class="nav-tab">❓ FAQ</a>
                    <a href="#trusted" class="nav-tab">🏢 Zaufali nam</a>
                    
                    <!-- Oddzielne strony -->
                    <a href="#form" class="nav-tab">📝 Strona formularz</a>
                    <a href="#privacy" class="nav-tab">🔒 Polityka prywatności</a>
                    <a href="#terms" class="nav-tab">📄 Regulamin</a>
                </nav>
                
                <!-- Hero Section -->
                <div id="hero" class="tab-content active">
                    <h2>🎯 Hero Section</h2>
                    <form method="post" action="">
                        <?php wp_nonce_field('doginvoice_save', 'doginvoice_nonce'); ?>
                        <input type="hidden" name="section" value="hero" />
                        <table class="form-table">
                        <tr>
                            <th scope="row">Tytuł główny</th>
                            <td><input type="text" name="hero_title" value="<?php echo esc_attr($content['hero_title'] ?? 'Robisz zdjęcie faktury, a reszta dzieje się automatycznie'); ?>" class="regular-text" /></td>
                        </tr>
                        <tr>
                            <th scope="row">Opis</th>
                            <td><textarea name="hero_description" rows="3" class="large-text"><?php echo esc_textarea($content['hero_description'] ?? 'DogInvoice automatycznie organizuje Twoje dokumenty, eliminuje chaos administracyjny i pozwala Ci skupić się na tym, co naprawdę ważne.'); ?></textarea></td>
                        </tr>
                        <tr>
                            <th scope="row">📹 Plik Video</th>
                            <td>
                                <input type="file" name="hero_video_file" accept="video/mp4,video/webm,video/ogg" />
                                <p class="description">Wgraj plik video (MP4, WebM) lub podaj URL poniżej</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">🔗 URL Video (alternatywnie)</th>
                            <td><input type="text" name="hero_video_url" value="<?php echo esc_attr($content['hero_video_url'] ?? '/videos/doginvoice_hero.mp4'); ?>" class="regular-text" placeholder="/videos/file.mp4, https://example.com/video.mp4" /></td>
                        </tr>
                        <tr>
                            <th scope="row">🖼️ Poster Video</th>
                            <td>
                                <input type="file" name="hero_video_poster" accept="image/*" />
                                <p class="description">Obrazek wyświetlany przed załadowaniem video</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Przycisk główny - tekst</th>
                            <td><input type="text" name="hero_cta_primary_text" value="<?php echo esc_attr($content['hero_cta_primary_text'] ?? 'Wybierz swój plan'); ?>" class="regular-text" /></td>
                        </tr>
                        <tr>
                            <th scope="row">Przycisk główny - URL</th>
                            <td>
                                <input type="text" name="hero_cta_primary_url" value="<?php echo esc_attr($content['hero_cta_primary_url'] ?? '#pricing'); ?>" class="regular-text" placeholder="#pricing, /trial, https://example.com" />
                                <p class="description">Możesz użyć: #sekcja (odnośnik do sekcji), /strona (względny URL), https://example.com (pełny URL)</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Przycisk drugi - tekst</th>
                            <td><input type="text" name="hero_cta_secondary_text" value="<?php echo esc_attr($content['hero_cta_secondary_text'] ?? 'Przetestuj za darmo'); ?>" class="regular-text" /></td>
                        </tr>
                        <tr>
                            <th scope="row">Przycisk drugi - URL</th>
                            <td>
                                <input type="text" name="hero_cta_secondary_url" value="<?php echo esc_attr($content['hero_cta_secondary_url'] ?? '/trial'); ?>" class="regular-text" placeholder="#pricing, /trial, https://example.com" />
                                <p class="description">Możesz użyć: #sekcja (odnośnik do sekcji), /strona (względny URL), https://example.com (pełny URL)</p>
                            </td>
                        </tr>
                        </table>
                        <p class="submit">
                            <input type="submit" name="submit" class="button-primary" value="Zapisz Hero Section" />
                        </p>
                    </form>
                </div>
                
                <!-- Animated Numbers -->
                <div id="numbers" class="tab-content">
                    <h2>📊 Liczby animowane</h2>
                    <p>Dodaj 3 liczby do animacji</p>
                    <form method="post" action="">
                        <?php wp_nonce_field('doginvoice_save', 'doginvoice_nonce'); ?>
                        <input type="hidden" name="section" value="numbers" />
                        <div id="numbers-container">
                        <?php 
                        $numbers = $content['animated_numbers'] ?? array();
                        for ($i = 0; $i < 3; $i++): 
                            $number = $numbers[$i] ?? array();
                        ?>
                        <div class="number-item" style="border: 1px solid #ddd; padding: 15px; margin: 10px 0; background: #f9f9f9;">
                            <h4>Liczba <?php echo $i + 1; ?></h4>
                            <table class="form-table">
                                <tr>
                                    <th scope="row">Wartość</th>
                                    <td><input type="number" name="animated_numbers[<?php echo $i; ?>][value]" value="<?php echo esc_attr($number['value'] ?? ''); ?>" /></td>
                                </tr>
                                <tr>
                                    <th scope="row">Sufiks</th>
                                    <td><input type="text" name="animated_numbers[<?php echo $i; ?>][suffix]" value="<?php echo esc_attr($number['suffix'] ?? '+'); ?>" /></td>
                                </tr>
                                <tr>
                                    <th scope="row">Tytuł</th>
                                    <td><input type="text" name="animated_numbers[<?php echo $i; ?>][title]" value="<?php echo esc_attr($number['title'] ?? ''); ?>" class="regular-text" /></td>
                                </tr>
                                <tr>
                                    <th scope="row">Opis</th>
                                    <td><input type="text" name="animated_numbers[<?php echo $i; ?>][description]" value="<?php echo esc_attr($number['description'] ?? ''); ?>" class="regular-text" /></td>
                                </tr>
                                <tr>
                                    <th scope="row">Kolor</th>
                                    <td>
                                        <select name="animated_numbers[<?php echo $i; ?>][color]">
                                            <option value="text-primary" <?php selected($number['color'] ?? 'text-primary', 'text-primary'); ?>>Primary</option>
                                            <option value="text-orange-500" <?php selected($number['color'] ?? '', 'text-orange-500'); ?>>Orange</option>
                                            <option value="text-blue-500" <?php selected($number['color'] ?? '', 'text-blue-500'); ?>>Blue</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php endfor; ?>
                        </div>
                        <p class="submit">
                            <input type="submit" name="submit" class="button-primary" value="Zapisz Liczby animowane" />
                        </p>
                    </form>
                </div>
                
                <!-- Process Steps -->
                <div id="process" class="tab-content">
                    <h2>🔄 Kroki procesu</h2>
                    <p>Dodaj 5 kroków procesu</p>
                    <form method="post" action="">
                        <?php wp_nonce_field('doginvoice_save', 'doginvoice_nonce'); ?>
                        <input type="hidden" name="section" value="process" />
                        <div id="process-container">
                        <?php 
                        $steps = $content['process_steps'] ?? array();
                        for ($i = 0; $i < 5; $i++): 
                            $step = $steps[$i] ?? array();
                        ?>
                        <div class="step-item" style="border: 1px solid #ddd; padding: 15px; margin: 10px 0; background: #f9f9f9;">
                            <h4>Krok <?php echo $i + 1; ?></h4>
                            <table class="form-table">
                                <tr>
                                    <th scope="row">Numer kroku</th>
                                    <td><input type="text" name="process_steps[<?php echo $i; ?>][step_number]" value="<?php echo esc_attr($step['step_number'] ?? sprintf('%02d', $i + 1)); ?>" maxlength="2" /></td>
                                </tr>
                                <tr>
                                    <th scope="row">Tytuł kroku</th>
                                    <td><input type="text" name="process_steps[<?php echo $i; ?>][step_title]" value="<?php echo esc_attr($step['step_title'] ?? ''); ?>" class="regular-text" /></td>
                                </tr>
                                <tr>
                                    <th scope="row">Opis kroku</th>
                                    <td><textarea name="process_steps[<?php echo $i; ?>][step_description]" rows="3" class="large-text"><?php echo esc_textarea($step['step_description'] ?? ''); ?></textarea></td>
                                </tr>
                                <tr>
                                    <th scope="row">Ikona</th>
                                    <td>
                                        <select name="process_steps[<?php echo $i; ?>][step_icon]">
                                            <option value="upload" <?php selected($step['step_icon'] ?? 'upload', 'upload'); ?>>Upload (Wielokanałowy odbiór)</option>
                                            <option value="check-circle" <?php selected($step['step_icon'] ?? '', 'check-circle'); ?>>Check Circle (Weryfikacja)</option>
                                            <option value="brain" <?php selected($step['step_icon'] ?? '', 'brain'); ?>>Brain (Analiza AI)</option>
                                            <option value="folder-open" <?php selected($step['step_icon'] ?? '', 'folder-open'); ?>>Folder Open (Archiwizacja)</option>
                                            <option value="bar-chart-3" <?php selected($step['step_icon'] ?? '', 'bar-chart-3'); ?>>Bar Chart (Dashboard)</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">🖼️ Miniaturka</th>
                                    <td>
                                        <input type="file" name="process_steps[<?php echo $i; ?>][step_thumbnail_file]" accept="image/*" />
                                        <p class="description">Obrazek wyświetlany jako miniaturka kroku</p>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">🔗 URL Miniaturki (alternatywnie)</th>
                                    <td><input type="text" name="process_steps[<?php echo $i; ?>][step_thumbnail_url]" value="<?php echo esc_attr($step['step_thumbnail_url'] ?? ''); ?>" class="regular-text" placeholder="/steps/step01.png, https://example.com/image.png" /></td>
                                </tr>
                                <tr>
                                    <th scope="row">📹 Plik Video</th>
                                    <td>
                                        <input type="file" name="process_steps[<?php echo $i; ?>][step_video_file]" accept="video/mp4,video/webm,video/ogg" />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">🔗 URL Video (alternatywnie)</th>
                                    <td><input type="text" name="process_steps[<?php echo $i; ?>][step_video_url]" value="<?php echo esc_attr($step['step_video_url'] ?? ''); ?>" class="regular-text" placeholder="/videos/file.mp4, https://example.com/video.mp4" /></td>
                                </tr>
                                <tr>
                                    <th scope="row">Pozycja X (%)</th>
                                    <td><input type="number" name="process_steps[<?php echo $i; ?>][step_position_x]" value="<?php echo esc_attr($step['step_position_x'] ?? 50); ?>" min="0" max="100" /></td>
                                </tr>
                                <tr>
                                    <th scope="row">Pozycja Y (%)</th>
                                    <td><input type="number" name="process_steps[<?php echo $i; ?>][step_position_y]" value="<?php echo esc_attr($step['step_position_y'] ?? 50); ?>" min="0" max="100" /></td>
                                </tr>
                            </table>
                        </div>
                        <?php endfor; ?>
                        </div>
                        <p class="submit">
                            <input type="submit" name="submit" class="button-primary" value="Zapisz Kroki procesu" />
                        </p>
                    </form>
                </div>
                
                <!-- Features -->
                <div id="features" class="tab-content">
                    <h2>💡 Korzyści</h2>
                    <p>Dodaj korzyści z używania DogInvoice</p>
                    <form method="post" action="">
                        <?php wp_nonce_field('doginvoice_save', 'doginvoice_nonce'); ?>
                        <input type="hidden" name="section" value="features" />
                        <table class="form-table">
                            <tr>
                                <th scope="row">Główny nagłówek sekcji</th>
                                <td><input type="text" name="features_title" value="<?php echo esc_attr($content['features_title'] ?? 'Funkcjonalności automatyzujące pracę księgowości'); ?>" class="regular-text" /></td>
                            </tr>
                            <tr>
                                <th scope="row">Opis sekcji</th>
                                <td><textarea name="features_description" rows="3" class="large-text"><?php echo esc_textarea($content['features_description'] ?? 'Poznaj główne zalety naszego systemu.'); ?></textarea></td>
                            </tr>
                        </table>
                        <hr style="margin: 20px 0;">
                        <h3>Korzyści</h3>
                        <div id="features-container">
                        <?php 
                        $features = $content['features'] ?? array();
                        $features_count = max(6, count($features));
                        for ($i = 0; $i < $features_count; $i++): 
                            $feature = $features[$i] ?? array();
                        ?>
                        <div class="feature-item" style="border: 1px solid #ddd; padding: 15px; margin: 10px 0; background: #f9f9f9;">
                            <h4>Korzyść <?php echo $i + 1; ?></h4>
                            <table class="form-table">
                                <tr>
                                    <th scope="row">Tytuł korzyści</th>
                                    <td><input type="text" name="features[<?php echo $i; ?>][feature_title]" value="<?php echo esc_attr($feature['feature_title'] ?? ''); ?>" class="regular-text" /></td>
                                </tr>
                                <tr>
                                    <th scope="row">Opis korzyści</th>
                                    <td><textarea name="features[<?php echo $i; ?>][feature_description]" rows="4" class="large-text"><?php echo esc_textarea($feature['feature_description'] ?? ''); ?></textarea></td>
                                </tr>
                                <tr>
                                    <th scope="row">Ikona</th>
                                    <td>
                                        <select name="features[<?php echo $i; ?>][feature_icon]">
                                            <option value="zap" <?php selected($feature['feature_icon'] ?? 'zap', 'zap'); ?>>Zap (Automatyzacja)</option>
                                            <option value="settings" <?php selected($feature['feature_icon'] ?? '', 'settings'); ?>>Settings (Analiza finansowa)</option>
                                            <option value="trending-up" <?php selected($feature['feature_icon'] ?? '', 'trending-up'); ?>>Trending Up (Wzrost)</option>
                                            <option value="shield" <?php selected($feature['feature_icon'] ?? '', 'shield'); ?>>Shield (Bezpieczeństwo)</option>
                                            <option value="clock" <?php selected($feature['feature_icon'] ?? '', 'clock'); ?>>Clock (Czas rzeczywisty)</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">🖼️ Poster Video</th>
                                    <td>
                                        <input type="file" name="features[<?php echo $i; ?>][feature_poster_file]" accept="image/*" />
                                        <p class="description">Obrazek wyświetlany przed załadowaniem video</p>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">🔗 URL Poster (alternatywnie)</th>
                                    <td><input type="text" name="features[<?php echo $i; ?>][feature_poster_url]" value="<?php echo esc_attr($feature['feature_poster_url'] ?? ''); ?>" class="regular-text" placeholder="/cover_1.png, https://example.com/poster.png" /></td>
                                </tr>
                                <tr>
                                    <th scope="row">📹 Plik Video</th>
                                    <td>
                                        <input type="file" name="features[<?php echo $i; ?>][feature_video_file]" accept="video/mp4,video/webm,video/ogg" />
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">🔗 URL Video (alternatywnie)</th>
                                    <td><input type="text" name="features[<?php echo $i; ?>][feature_video_url]" value="<?php echo esc_attr($feature['feature_video_url'] ?? ''); ?>" class="regular-text" placeholder="/videos/file.mp4, https://example.com/video.mp4" /></td>
                                </tr>
                            </table>
                        </div>
                        <?php endfor; ?>
                        </div>
                        <p class="submit">
                            <input type="submit" name="submit" class="button-primary" value="Zapisz Korzyści" />
                        </p>
                    </form>
                </div>
                
                <!-- Integrations -->
                <div id="integrations" class="tab-content">
                    <h2>🔗 Integracje</h2>
                    <p>Dodaj integracje z systemami zewnętrznymi</p>
                    <form method="post" action="">
                        <?php wp_nonce_field('doginvoice_save', 'doginvoice_nonce'); ?>
                        <input type="hidden" name="section" value="integrations" />
                        <div id="integrations-container">
                        <?php 
                        $integrations = $content['integrations'] ?? array();
                        $integrations_count = max(3, count($integrations));
                        for ($i = 0; $i < $integrations_count; $i++): 
                            $integration = $integrations[$i] ?? array();
                        ?>
                        <div class="integration-item" style="border: 1px solid #ddd; padding: 20px; margin: 10px 0; background: #f9f9f9;">
                            <h3>Integracja <?php echo $i + 1; ?></h3>
                            <table class="form-table">
                                <tr>
                                    <th scope="row">Nazwa integracji</th>
                                    <td><input type="text" name="integrations[<?php echo $i; ?>][integration_name]" value="<?php echo esc_attr($integration['integration_name'] ?? ''); ?>" class="regular-text" /></td>
                                </tr>
                                <tr>
                                    <th scope="row">Nazwa komponentu SVG</th>
                                    <td><input type="text" name="integrations[<?php echo $i; ?>][integration_component]" value="<?php echo esc_attr($integration['integration_component'] ?? ''); ?>" class="regular-text" placeholder="SmtpImapIcon, GmailLogo, GoogleDriveLogo" /></td>
                                </tr>
                                <tr>
                                    <th scope="row">Wysokość logo (CSS)</th>
                                    <td><input type="text" name="integrations[<?php echo $i; ?>][integration_height]" value="<?php echo esc_attr($integration['integration_height'] ?? 'h-[30px]'); ?>" class="regular-text" placeholder="h-[30px], h-[25px], h-[35px]" /></td>
                                </tr>
                                <tr>
                                    <th scope="row">Wkrótce dostępne</th>
                                    <td><input type="checkbox" name="integrations[<?php echo $i; ?>][integration_coming_soon]" value="1" <?php checked($integration['integration_coming_soon'] ?? false, true); ?> /></td>
                                </tr>
                            </table>
                        </div>
                        <?php endfor; ?>
                        </div>
                        <p class="submit">
                            <input type="submit" name="submit" class="button-primary" value="Zapisz Integracje" />
                        </p>
                    </form>
                </div>
                
                <!-- Benefits -->
                <div id="benefits" class="tab-content">
                    <h2>⚡ Funkcjonalności</h2>
                    <p>Dodaj funkcjonalności produktu (3-10)</p>
                    <form method="post" action="">
                        <?php wp_nonce_field('doginvoice_save', 'doginvoice_nonce'); ?>
                        <input type="hidden" name="section" value="benefits" />
                        <table class="form-table">
                            <tr>
                                <th scope="row">Główny nagłówek sekcji</th>
                                <td><input type="text" name="benefits_title" value="<?php echo esc_attr($content['benefits_title'] ?? 'Zmień sposób zarządzania finansami'); ?>" class="regular-text" /></td>
                            </tr>
                            <tr>
                                <th scope="row">Opis sekcji</th>
                                <td><textarea name="benefits_description" rows="3" cols="50" class="large-text"><?php echo esc_textarea($content['benefits_description'] ?? 'Poznaj trzy fundamenty, które poprawią wydajność pracy księgowej.'); ?></textarea></td>
                            </tr>
                        </table>
                        <div id="benefits-container">
                        <?php 
                        $benefits = $content['benefits'] ?? array();
                        $benefits_count = max(6, count($benefits));
                        for ($i = 0; $i < $benefits_count; $i++): 
                            $benefit = $benefits[$i] ?? array();
                        ?>
                        <div class="benefit-item" style="border: 1px solid #ddd; padding: 20px; margin: 10px 0; background: #f9f9f9;">
                            <h3>Funkcjonalność <?php echo $i + 1; ?></h3>
                            <table class="form-table">
                                <tr>
                                    <th scope="row">Tytuł funkcjonalności</th>
                                    <td><input type="text" name="benefits[<?php echo $i; ?>][benefit_title]" value="<?php echo esc_attr($benefit['benefit_title'] ?? ''); ?>" class="regular-text" /></td>
                                </tr>
                                <tr>
                                    <th scope="row">Opis funkcjonalności</th>
                                    <td><textarea name="benefits[<?php echo $i; ?>][benefit_description]" rows="3" class="large-text"><?php echo esc_textarea($benefit['benefit_description'] ?? ''); ?></textarea></td>
                                </tr>
                                <tr>
                                    <th scope="row">Ikona</th>
                                    <td><input type="text" name="benefits[<?php echo $i; ?>][benefit_icon]" value="<?php echo esc_attr($benefit['benefit_icon'] ?? ''); ?>" class="regular-text" placeholder="clock, check-circle, folder" /></td>
                                </tr>
                                <tr>
                                    <th scope="row">Podświetlenie</th>
                                    <td><input type="text" name="benefits[<?php echo $i; ?>][benefit_highlight]" value="<?php echo esc_attr($benefit['benefit_highlight'] ?? ''); ?>" maxlength="20" /></td>
                                </tr>
                            </table>
                        </div>
                        <?php endfor; ?>
                        </div>
                        <p class="submit">
                            <input type="submit" name="submit" class="button-primary" value="Zapisz Funkcjonalności" />
                        </p>
                    </form>
                </div>
                
                <!-- Pricing Plans -->
                <div id="pricing" class="tab-content">
                    <h2>💰 Plany cenowe</h2>
                    <p>Dodaj plany cenowe</p>
                    <form method="post" action="">
                        <?php wp_nonce_field('doginvoice_save', 'doginvoice_nonce'); ?>
                        <input type="hidden" name="section" value="pricing" />
                        <div id="pricing-container">
                        <?php 
                        $pricing_plans = $content['pricing_plans'] ?? array();
                        $pricing_count = max(3, count($pricing_plans));
                        for ($i = 0; $i < $pricing_count; $i++): 
                            $plan = $pricing_plans[$i] ?? array();
                        ?>
                        <div class="pricing-item" style="border: 1px solid #ddd; padding: 20px; margin: 10px 0; background: #f9f9f9;">
                            <h3>Plan <?php echo $i + 1; ?></h3>
                            <table class="form-table">
                                <tr>
                                    <th scope="row">Nazwa planu</th>
                                    <td><input type="text" name="pricing_plans[<?php echo $i; ?>][plan_name]" value="<?php echo esc_attr($plan['plan_name'] ?? ''); ?>" class="regular-text" /></td>
                                </tr>
                                <tr>
                                    <th scope="row">ID planu</th>
                                    <td><input type="text" name="pricing_plans[<?php echo $i; ?>][plan_id]" value="<?php echo esc_attr($plan['plan_id'] ?? ''); ?>" class="regular-text" placeholder="starter, professional, business, enterprise" /></td>
                                </tr>
                                <tr>
                                    <th scope="row">Opis planu</th>
                                    <td><textarea name="pricing_plans[<?php echo $i; ?>][plan_description]" rows="2" class="large-text"><?php echo esc_textarea($plan['plan_description'] ?? ''); ?></textarea></td>
                                </tr>
                                <tr>
                                    <th scope="row">Liczba faktur</th>
                                    <td><input type="text" name="pricing_plans[<?php echo $i; ?>][plan_invoices]" value="<?php echo esc_attr($plan['plan_invoices'] ?? ''); ?>" class="regular-text" placeholder="10 faktur miesięcznie" /></td>
                                </tr>
                                <tr>
                                    <th scope="row">Cena miesięczna</th>
                                    <td><input type="number" name="pricing_plans[<?php echo $i; ?>][plan_monthly_price]" value="<?php echo esc_attr($plan['plan_monthly_price'] ?? ''); ?>" class="regular-text" placeholder="149" /></td>
                                </tr>
                                <tr>
                                    <th scope="row">Tekst przycisku</th>
                                    <td><input type="text" name="pricing_plans[<?php echo $i; ?>][plan_button_text]" value="<?php echo esc_attr($plan['plan_button_text'] ?? ''); ?>" class="regular-text" /></td>
                                </tr>
                                <tr>
                                    <th scope="row">URL przycisku</th>
                                    <td><input type="text" name="pricing_plans[<?php echo $i; ?>][plan_button_url]" value="<?php echo esc_attr($plan['plan_button_url'] ?? ''); ?>" class="regular-text" placeholder="/trial?plan=starter" /></td>
                                </tr>
                                <tr>
                                    <th scope="row">Najpopularniejszy plan</th>
                                    <td><input type="checkbox" name="pricing_plans[<?php echo $i; ?>][plan_is_popular]" value="1" <?php checked($plan['plan_is_popular'] ?? false, true); ?> /></td>
                                </tr>
                            </table>
                        </div>
                        <?php endfor; ?>
                        </div>
                        <p class="submit">
                            <input type="submit" name="submit" class="button-primary" value="Zapisz Plany cenowe" />
                        </p>
                    </form>
                </div>
                
                <!-- FAQ -->
                <div id="faq" class="tab-content">
                    <h2>❓ FAQ</h2>
                    <p>Dodaj pytania i odpowiedzi</p>
                    <form method="post" action="">
                        <?php wp_nonce_field('doginvoice_save', 'doginvoice_nonce'); ?>
                        <input type="hidden" name="section" value="faq" />
                        <div id="faq-container">
                        <?php 
                        $faq = $content['faq'] ?? array();
                        $faq_count = max(3, count($faq));
                        for ($i = 0; $i < $faq_count; $i++): 
                            $faq_item = $faq[$i] ?? array();
                        ?>
                        <div class="faq-item" style="border: 1px solid #ddd; padding: 20px; margin: 10px 0; background: #f9f9f9;">
                            <h3>FAQ <?php echo $i + 1; ?></h3>
                            <table class="form-table">
                                <tr>
                                    <th scope="row">Pytanie</th>
                                    <td><input type="text" name="faq[<?php echo $i; ?>][faq_question]" value="<?php echo esc_attr($faq_item['faq_question'] ?? ''); ?>" class="large-text" /></td>
                                </tr>
                                <tr>
                                    <th scope="row">Odpowiedź</th>
                                    <td><textarea name="faq[<?php echo $i; ?>][faq_answer]" rows="4" class="large-text"><?php echo esc_textarea($faq_item['faq_answer'] ?? ''); ?></textarea></td>
                                </tr>
                            </table>
                        </div>
                        <?php endfor; ?>
                        </div>
                        <p class="submit">
                            <input type="submit" name="submit" class="button-primary" value="Zapisz FAQ" />
                        </p>
                    </form>
                </div>
                
                <!-- Trusted By -->
                <div id="trusted" class="tab-content">
                    <h2>🏢 Zaufali nam</h2>
                    <form method="post" action="">
                        <?php wp_nonce_field('doginvoice_save', 'doginvoice_nonce'); ?>
                        <input type="hidden" name="section" value="trusted" />
                        <div id="trusted-container">
                        <?php 
                        $trusted_logos = $content['trusted_by']['trusted_by_logos'] ?? array();
                        $trusted_count = max(4, count($trusted_logos));
                        for ($i = 0; $i < $trusted_count; $i++): 
                            $logo = $trusted_logos[$i] ?? array();
                        ?>
                        <div class="trusted-item" style="border: 1px solid #ddd; padding: 15px; margin: 10px 0; background: #f9f9f9;">
                            <h4>Logo <?php echo $i + 1; ?></h4>
                            <table class="form-table">
                                <tr>
                                    <th scope="row">Nazwa firmy</th>
                                    <td><input type="text" name="trusted_by_logos[<?php echo $i; ?>][logo_name]" value="<?php echo esc_attr($logo['logo_name'] ?? ''); ?>" class="regular-text" /></td>
                                </tr>
                                <tr>
                                    <th scope="row">URL firmy</th>
                                    <td><input type="text" name="trusted_by_logos[<?php echo $i; ?>][logo_url]" value="<?php echo esc_attr($logo['logo_url'] ?? ''); ?>" class="regular-text" placeholder="https://example.com" /></td>
                                </tr>
                                <tr>
                                    <th scope="row">Logo firmy</th>
                                    <td><input type="text" name="trusted_by_logos[<?php echo $i; ?>][logo_path]" value="<?php echo esc_attr($logo['logo_path'] ?? ''); ?>" class="regular-text" placeholder="/assets/logo.svg" /></td>
                                </tr>
                                <tr>
                                    <th scope="row">Wysokość logo (CSS)</th>
                                    <td><input type="text" name="trusted_by_logos[<?php echo $i; ?>][logo_height]" value="<?php echo esc_attr($logo['logo_height'] ?? 'h-[30px]'); ?>" class="regular-text" placeholder="h-[30px], h-[20px]" /></td>
                                </tr>
                            </table>
                        </div>
                        <?php endfor; ?>
                        </div>
                        <p class="submit">
                            <input type="submit" name="submit" class="button-primary" value="Zapisz Zaufali nam" />
                        </p>
                    </form>
                </div>
                
                <!-- CTA Section -->
                <div id="cta" class="tab-content">
                    <h2>📢 CTA Section</h2>
                    <form method="post" action="">
                        <?php wp_nonce_field('doginvoice_save', 'doginvoice_nonce'); ?>
                        <input type="hidden" name="section" value="cta" />
                        <table class="form-table">
                            <tr>
                                <th scope="row">Tytuł CTA</th>
                                <td><input type="text" name="cta_title" value="<?php echo esc_attr($content['cta_title'] ?? 'Zacznij już dziś'); ?>" class="regular-text" /></td>
                            </tr>
                            <tr>
                                <th scope="row">Podtytuł CTA</th>
                                <td><textarea name="cta_subtitle" rows="3" class="large-text"><?php echo esc_textarea($content['cta_subtitle'] ?? 'Dołącz do firm, które oszczędzają 15 godzin tygodniowo dzięki automatyzacji.'); ?></textarea></td>
                            </tr>
                            <tr>
                                <th scope="row">Tekst pierwszego przycisku</th>
                                <td><input type="text" name="cta_button_primary_text" value="<?php echo esc_attr($content['cta_button_primary_text'] ?? 'Wybierz swój plan'); ?>" class="regular-text" /></td>
                            </tr>
                            <tr>
                                <th scope="row">URL pierwszego przycisku</th>
                                <td><input type="text" name="cta_button_primary_url" value="<?php echo esc_attr($content['cta_button_primary_url'] ?? '#pricing'); ?>" class="regular-text" placeholder="#pricing" /></td>
                            </tr>
                            <tr>
                                <th scope="row">Tekst drugiego przycisku</th>
                                <td><input type="text" name="cta_button_secondary_text" value="<?php echo esc_attr($content['cta_button_secondary_text'] ?? 'Przetestuj za darmo'); ?>" class="regular-text" /></td>
                            </tr>
                            <tr>
                                <th scope="row">URL drugiego przycisku</th>
                                <td><input type="text" name="cta_button_secondary_url" value="<?php echo esc_attr($content['cta_button_secondary_url'] ?? '/trial'); ?>" class="regular-text" placeholder="/trial" /></td>
                            </tr>
                        </table>
                        <p class="submit">
                            <input type="submit" name="submit" class="button-primary" value="Zapisz CTA Section" />
                        </p>
                    </form>
                </div>
                
                <!-- Form Page -->
                <div id="form" class="tab-content">
                    <h2>📝 Strona formularz</h2>
                    <form method="post" action="">
                        <?php wp_nonce_field('doginvoice_save', 'doginvoice_nonce'); ?>
                        <input type="hidden" name="section" value="form" />
                        <table class="form-table">
                        <tr>
                            <th scope="row">Tytuł strony</th>
                            <td><input type="text" name="form_title" value="<?php echo esc_attr($content['form_title'] ?? 'Wybierz swój plan i rozpocznij test'); ?>" class="regular-text" /></td>
                        </tr>
                        <tr>
                            <th scope="row">Opis strony</th>
                            <td><textarea name="form_description" rows="3" class="large-text"><?php echo esc_textarea($content['form_description'] ?? 'Wypełnij formularz, a nasz konsultant skontaktuje się z Tobą w celu finalizacji transakcji.'); ?></textarea></td>
                        </tr>
                        <tr>
                            <th scope="row">Webhook URL</th>
                            <td>
                                <input type="text" name="form_webhook_url" value="<?php echo esc_attr($content['form_webhook_url'] ?? ''); ?>" class="regular-text" placeholder="https://hooks.zapier.com/hooks/catch/..." />
                                <p class="description">URL do wysyłania danych z formularza</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Lista branż (jedna na linię)</th>
                            <td>
                                <textarea name="form_industries" rows="10" class="large-text"><?php echo esc_textarea(is_array($content['form_industries'] ?? '') ? implode("\n", $content['form_industries']) : ($content['form_industries'] ?? 'Technologie informacyjne
Handel detaliczny
Produkcja
Usługi finansowe
Opieka zdrowotna
Edukacja
Budownictwo
Transport i logistyka
Gastronomia
Inna')); ?></textarea>
                                <p class="description">Lista branż do wyboru w formularzu</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Plany cenowe (JSON)</th>
                            <td>
                                <textarea name="form_plans" rows="15" class="large-text"><?php echo esc_textarea($content['form_plans'] ?? '[
  {
    "id": "starter",
    "name": "Starter",
    "monthly": {
      "price": "0 zł",
      "description": "10 faktur miesięcznie"
    },
    "yearly": null
  },
  {
    "id": "professional", 
    "name": "Professional",
    "monthly": {
      "price": "149 zł netto/mies.",
      "description": "150 faktur miesięcznie"
    },
    "yearly": {
      "price": "74,50 zł netto/mies.",
      "description": "Oszczędzasz 894 zł rocznie"
    }
  },
  {
    "id": "business",
    "name": "Business", 
    "monthly": {
      "price": "299 zł netto/mies.",
      "description": "500 faktur miesięcznie"
    },
    "yearly": {
      "price": "149,50 zł netto/mies.",
      "description": "Oszczędzasz 1 794 zł rocznie"
    }
  },
  {
    "id": "enterprise",
    "name": "Enterprise",
    "monthly": {
      "price": "Wycena indywidualna",
      "description": "Niestandardowe rozwiązania"
    },
    "yearly": {
      "price": "Wycena indywidualna", 
      "description": "Niestandardowe rozwiązania"
    }
  }
]'); ?></textarea>
                                <p class="description">Plany cenowe w formacie JSON</p>
                            </td>
                        </tr>
                        </table>
                        <p class="submit">
                            <input type="submit" name="submit" class="button-primary" value="Zapisz Strona formularz" />
                        </p>
                    </form>
                </div>
                
                <!-- Privacy Policy -->
                <div id="privacy" class="tab-content">
                    <h2>🔒 Polityka prywatności</h2>
                    <form method="post" action="">
                        <?php wp_nonce_field('doginvoice_save', 'doginvoice_nonce'); ?>
                        <input type="hidden" name="section" value="privacy" />
                        <table class="form-table">
                        <tr>
                            <th scope="row">Tytuł strony</th>
                            <td><input type="text" name="privacy_title" value="<?php echo esc_attr($content['privacy_title'] ?? 'Polityka prywatności i cookies'); ?>" class="regular-text" /></td>
                        </tr>
                        <tr>
                            <th scope="row">Treść polityki (HTML)</th>
                            <td><textarea name="privacy_content" rows="30" class="large-text"><?php echo esc_textarea($content['privacy_content'] ?? '<section>
  <h2 class="text-xl font-semibold text-primary mb-3">
    Informacje ogólne
  </h2>

  <h3 class="font-medium mb-2">
    1.1 Administrator danych osobowych
  </h3>
  <p>Administratorem Państwa danych osobowych jest:</p>
  <p class="mt-2">
    Dogtronic Sp. z o.o. z siedzibą w Lublinie ul. Hajdowska 43C, 20-231 Lublin, wpisaną do rejestru przedsiębiorców Krajowego Rejestru Sądowego prowadzonego przez Sąd Rejonowy Lublin-Wschód w Lublinie z siedzibą w Świdniku, VI Wydział Gospodarczy Krajowego Rejestru Sądowego pod nr KRS: 0000780413, NIP: 7123385053, REGON: 383012590;
    <br />
    Adres e-mail: <a class="underline" href="mailto:rodo@doginvoice.com">rodo@doginvoice.com</a>
  </p>

  <h3 class="font-medium mt-6 mb-2">
    1.2 Inspektor Ochrony Danych
  </h3>
  <p>
    W sprawach dotyczących ochrony danych osobowych można się
    kontaktować z naszym Inspektorem Ochrony Danych: e-mail: 
    <a class="underline" href="mailto:iod@doginvoice.com">iod@doginvoice.com</a>
  </p>
</section>'); ?></textarea></td>
                        </tr>
                        <tr>
                            <th scope="row">Data ostatniej aktualizacji</th>
                            <td><input type="date" name="privacy_last_updated" value="<?php echo esc_attr($content['privacy_last_updated'] ?? date('Y-m-d')); ?>" /></td>
                        </tr>
                        </table>
                        <p class="submit">
                            <input type="submit" name="submit" class="button-primary" value="Zapisz Polityka prywatności" />
                        </p>
                    </form>
                </div>
                
                <!-- Terms of Service -->
                <div id="terms" class="tab-content">
                    <h2>📄 Regulamin</h2>
                    <form method="post" action="">
                        <?php wp_nonce_field('doginvoice_save', 'doginvoice_nonce'); ?>
                        <input type="hidden" name="section" value="terms" />
                        <table class="form-table">
                        <tr>
                            <th scope="row">Tytuł strony</th>
                            <td><input type="text" name="terms_title" value="<?php echo esc_attr($content['terms_title'] ?? 'Regulamin'); ?>" class="regular-text" /></td>
                        </tr>
                        <tr>
                            <th scope="row">Treść regulaminu (HTML)</th>
                            <td><textarea name="terms_content" rows="30" class="large-text"><?php echo esc_textarea($content['terms_content'] ?? '<section>
  <h2 class="text-xl sm:text-l font-medium mb-4 text-primary">
    1. Postanowienia ogólne
  </h2>
  <p class="text-muted-foreground leading-relaxed">
    Niniejszy Regulamin określa zasady korzystania z platformy
    DogInvoice służącej do automatyzacji procesów księgowania
    faktur.
  </p>
</section>

<section>
  <h2 class="text-xl sm:text-l font-medium mb-4 text-primary">
    2. Definicje
  </h2>
  <ul class="list-disc list-outside space-y-2 text-muted-foreground pl-8 sm:pl-12 mt-4">
    <li>
      <strong>Usługodawca</strong> - Dogtronic Sp. z o.o.
    </li>
    <li>
      <strong>Usługobiorca</strong> - osoba fizyczna lub prawna
      korzystająca z Platformy
    </li>
    <li>
      <strong>Platforma</strong> - system informatyczny DogInvoice
    </li>
    <li>
      <strong>Konto</strong> - zbiór zasobów i ustawień Usługobiorcy
    </li>
  </ul>
</section>

<section>
  <h2 class="text-xl sm:text-l font-medium mb-4 text-primary">
    3. Zasady korzystania
  </h2>
  <p class="text-muted-foreground leading-relaxed mb-4">
    Korzystanie z Platformy wymaga:
  </p>
  <ul class="list-disc list-outside space-y-2 text-muted-foreground pl-8 sm:pl-12 mt-4">
    <li>Rejestracji konta z podaniem prawdziwych danych</li>
    <li>Akceptacji niniejszego Regulaminu</li>
    <li>Przestrzegania zasad bezpieczeństwa</li>
    <li>Używania Platformy zgodnie z jej przeznaczeniem</li>
  </ul>
</section>

<section>
  <h2 class="text-xl sm:text-l font-medium mb-4 text-primary">
    4. Odpowiedzialność
  </h2>
  <p class="text-muted-foreground leading-relaxed">
    Usługodawca dołożyć starań zapewnienie ciągłości działania
    Platformy, jednak nie ponosi odpowiedzialności za szkody
    wynikające z przerw technicznych lub błędów w przetwarzaniu
    danych.
  </p>
</section>

<section>
  <h2 class="text-xl sm:text-l font-medium mb-4 text-primary">
    5. Płatności
  </h2>
  <p class="text-muted-foreground leading-relaxed">
    Szczegółowe informacje o cenach i metodach płatności dostępne są
    w Cenniku. Płatności realizowane są przez bezpieczne systemy
    płatnicze.
  </p>
</section>

<section>
  <h2 class="text-xl sm:text-l font-medium mb-4 text-primary">
    6. Rozwiązanie umowy
  </h2>
  <p class="text-muted-foreground leading-relaxed">
    Umowa może zostać rozwiązana przez każdą ze stron z 30-dniowym
    wypowiedzeniem. W przypadku naruszenia Regulaminu umowa może
    zostać rozwiązana ze skutkiem natychmiastowym.
  </p>
</section>

<section>
  <h2 class="text-xl sm:text-l font-medium mb-4 text-primary">
    7. Postanowienia końcowe
  </h2>
  <p class="text-muted-foreground leading-relaxed">
    Regulamin może ulec zmianie. O zmianach informujemy z 14-dniowym
    wyprzedzeniem. W sprawach nieuregulowanych stosuje się przepisy
    prawa polskiego.
  </p>
</section>'); ?></textarea></td>
                        </tr>
                        <tr>
                            <th scope="row">Data ostatniej aktualizacji</th>
                            <td><input type="date" name="terms_last_updated" value="<?php echo esc_attr($content['terms_last_updated'] ?? date('Y-m-d')); ?>" /></td>
                        </tr>
                        </table>
                        <p class="submit">
                            <input type="submit" name="submit" class="button-primary" value="Zapisz Regulamin" />
                        </p>
                    </form>
                </div>
                
                <!-- Other tabs would go here... -->
                
            </div>
    </div>
    
    <style>
    .tab-content { display: none; }
    .tab-content.active { display: block; }
    .nav-tab-wrapper { margin-bottom: 20px; }
    </style>
    
    <script>
    jQuery(document).ready(function($) {
        $('.nav-tab').click(function(e) {
            e.preventDefault();
            $('.nav-tab').removeClass('nav-tab-active');
            $(this).addClass('nav-tab-active');
            $('.tab-content').removeClass('active');
            $($(this).attr('href')).addClass('active');
        });
    });
    </script>
    <?php
}

// Save content function for individual sections
function doginvoice_save_section($section) {
    // Get existing content
    $content = get_option('doginvoice_content', array());
    
    switch ($section) {
        case 'hero':
            $content['hero_title'] = sanitize_text_field($_POST['hero_title'] ?? '');
            $content['hero_description'] = sanitize_textarea_field($_POST['hero_description'] ?? '');
            $content['hero_video_url'] = sanitize_text_field($_POST['hero_video_url'] ?? '');
            $content['hero_cta_primary_text'] = sanitize_text_field($_POST['hero_cta_primary_text'] ?? '');
            $content['hero_cta_primary_url'] = sanitize_text_field($_POST['hero_cta_primary_url'] ?? '');
            $content['hero_cta_secondary_text'] = sanitize_text_field($_POST['hero_cta_secondary_text'] ?? '');
            $content['hero_cta_secondary_url'] = sanitize_text_field($_POST['hero_cta_secondary_url'] ?? '');
            break;
            
        case 'numbers':
            if (isset($_POST['animated_numbers'])) {
                $content['animated_numbers'] = array();
                foreach ($_POST['animated_numbers'] as $number) {
                    $content['animated_numbers'][] = array(
                        'value' => intval($number['value'] ?? 0),
                        'suffix' => sanitize_text_field($number['suffix'] ?? '+'),
                        'title' => sanitize_text_field($number['title'] ?? ''),
                        'description' => sanitize_text_field($number['description'] ?? ''),
                        'color' => sanitize_text_field($number['color'] ?? 'text-primary')
                    );
                }
            }
            break;
            
        case 'process':
            if (isset($_POST['process_steps'])) {
                $content['process_steps'] = array();
                foreach ($_POST['process_steps'] as $step) {
                    $content['process_steps'][] = array(
                        'step_number' => sanitize_text_field($step['step_number'] ?? ''),
                        'step_title' => sanitize_text_field($step['step_title'] ?? ''),
                        'step_description' => sanitize_textarea_field($step['step_description'] ?? ''),
                        'step_icon' => sanitize_text_field($step['step_icon'] ?? 'upload'),
                        'step_thumbnail_url' => sanitize_text_field($step['step_thumbnail_url'] ?? ''),
                        'step_video_url' => sanitize_text_field($step['step_video_url'] ?? ''),
                        'step_position_x' => intval($step['step_position_x'] ?? 50),
                        'step_position_y' => intval($step['step_position_y'] ?? 50)
                    );
                }
            }
            break;
            
        case 'features':
            $content['features_title'] = sanitize_text_field($_POST['features_title'] ?? '');
            $content['features_description'] = sanitize_textarea_field($_POST['features_description'] ?? '');
            if (isset($_POST['features'])) {
                $content['features'] = array();
                foreach ($_POST['features'] as $feature) {
                    if (!empty($feature['feature_title'])) {
                        $content['features'][] = array(
                            'feature_title' => sanitize_text_field($feature['feature_title']),
                            'feature_description' => sanitize_textarea_field($feature['feature_description'] ?? ''),
                            'feature_icon' => sanitize_text_field($feature['feature_icon'] ?? 'zap'),
                            'feature_poster_url' => sanitize_text_field($feature['feature_poster_url'] ?? ''),
                            'feature_video_url' => sanitize_text_field($feature['feature_video_url'] ?? '')
                        );
                    }
                }
            }
            break;
            
        case 'form':
            $content['form_title'] = sanitize_text_field($_POST['form_title'] ?? '');
            $content['form_description'] = sanitize_textarea_field($_POST['form_description'] ?? '');
            $content['form_webhook_url'] = sanitize_text_field($_POST['form_webhook_url'] ?? '');
            $content['form_industries'] = array_filter(array_map('trim', explode("\n", $_POST['form_industries'] ?? '')));
            $content['form_plans'] = sanitize_textarea_field($_POST['form_plans'] ?? '');
            break;
            
        case 'privacy':
            $content['privacy_title'] = sanitize_text_field($_POST['privacy_title'] ?? '');
            $content['privacy_content'] = sanitize_textarea_field($_POST['privacy_content'] ?? '');
            $content['privacy_last_updated'] = sanitize_text_field($_POST['privacy_last_updated'] ?? '');
            break;
            
        case 'terms':
            $content['terms_title'] = sanitize_text_field($_POST['terms_title'] ?? '');
            $content['terms_content'] = sanitize_textarea_field($_POST['terms_content'] ?? '');
            $content['terms_last_updated'] = sanitize_text_field($_POST['terms_last_updated'] ?? '');
            break;
            
        case 'integrations':
            if (isset($_POST['integrations'])) {
                $content['integrations'] = array();
                foreach ($_POST['integrations'] as $integration) {
                    if (!empty($integration['integration_name'])) {
                        $content['integrations'][] = array(
                            'integration_name' => sanitize_text_field($integration['integration_name']),
                            'integration_component' => sanitize_text_field($integration['integration_component'] ?? ''),
                            'integration_height' => sanitize_text_field($integration['integration_height'] ?? 'h-[30px]'),
                            'integration_coming_soon' => isset($integration['integration_coming_soon']) && $integration['integration_coming_soon'] == '1'
                        );
                    }
                }
            }
            break;
            
        case 'benefits':
            $content['benefits_title'] = sanitize_text_field($_POST['benefits_title'] ?? '');
            $content['benefits_description'] = sanitize_textarea_field($_POST['benefits_description'] ?? '');
            if (isset($_POST['benefits'])) {
                $content['benefits'] = array();
                foreach ($_POST['benefits'] as $benefit) {
                    if (!empty($benefit['benefit_title'])) {
                        $content['benefits'][] = array(
                            'benefit_title' => sanitize_text_field($benefit['benefit_title']),
                            'benefit_description' => sanitize_textarea_field($benefit['benefit_description'] ?? ''),
                            'benefit_icon' => sanitize_text_field($benefit['benefit_icon'] ?? ''),
                            'benefit_highlight' => sanitize_text_field($benefit['benefit_highlight'] ?? '')
                        );
                    }
                }
            }
            break;
            
        case 'pricing':
            if (isset($_POST['pricing_plans'])) {
                $content['pricing_plans'] = array();
                foreach ($_POST['pricing_plans'] as $plan) {
                    if (!empty($plan['plan_name'])) {
                        $content['pricing_plans'][] = array(
                            'plan_name' => sanitize_text_field($plan['plan_name']),
                            'plan_id' => sanitize_text_field($plan['plan_id'] ?? ''),
                            'plan_description' => sanitize_textarea_field($plan['plan_description'] ?? ''),
                            'plan_invoices' => sanitize_text_field($plan['plan_invoices'] ?? ''),
                            'plan_monthly_price' => intval($plan['plan_monthly_price'] ?? 0),
                            'plan_button_text' => sanitize_text_field($plan['plan_button_text'] ?? ''),
                            'plan_button_url' => sanitize_text_field($plan['plan_button_url'] ?? ''),
                            'plan_is_popular' => isset($plan['plan_is_popular']) && $plan['plan_is_popular'] == '1'
                        );
                    }
                }
            }
            break;
            
        case 'faq':
            if (isset($_POST['faq'])) {
                $content['faq'] = array();
                foreach ($_POST['faq'] as $faq_item) {
                    if (!empty($faq_item['faq_question'])) {
                        $content['faq'][] = array(
                            'faq_question' => sanitize_text_field($faq_item['faq_question']),
                            'faq_answer' => sanitize_textarea_field($faq_item['faq_answer'] ?? '')
                        );
                    }
                }
            }
            break;
            
        case 'trusted':
            if (isset($_POST['trusted_by_logos'])) {
                $content['trusted_by'] = array(
                    'trusted_by_title' => sanitize_text_field($_POST['trusted_by_title'] ?? ''),
                    'trusted_by_logos' => array()
                );
                foreach ($_POST['trusted_by_logos'] as $logo) {
                    if (!empty($logo['logo_name'])) {
                        $content['trusted_by']['trusted_by_logos'][] = array(
                            'logo_name' => sanitize_text_field($logo['logo_name']),
                            'logo_url' => sanitize_text_field($logo['logo_url'] ?? ''),
                            'logo_path' => sanitize_text_field($logo['logo_path'] ?? ''),
                            'logo_height' => sanitize_text_field($logo['logo_height'] ?? 'h-[30px]')
                        );
                    }
                }
            }
            break;
            
        case 'cta':
            $content['cta_title'] = sanitize_text_field($_POST['cta_title'] ?? '');
            $content['cta_subtitle'] = sanitize_textarea_field($_POST['cta_subtitle'] ?? '');
            $content['cta_button_primary_text'] = sanitize_text_field($_POST['cta_button_primary_text'] ?? '');
            $content['cta_button_primary_url'] = sanitize_text_field($_POST['cta_button_primary_url'] ?? '');
            $content['cta_button_secondary_text'] = sanitize_text_field($_POST['cta_button_secondary_text'] ?? '');
            $content['cta_button_secondary_url'] = sanitize_text_field($_POST['cta_button_secondary_url'] ?? '');
            break;
    }
    
    // Save to options
    update_option('doginvoice_content', $content);
}

// Helper function to get content
function get_doginvoice_content($key = null, $default = '') {
    $content = get_option('doginvoice_content', array());
    if ($key === null) {
        return $content;
    }
    return $content[$key] ?? $default;
}
?>
