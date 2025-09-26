<?php
/**
 * The main template file - Unified ACF Version
 * 
 * @package DogInvoice
 */

get_header(); ?>

<main id="main" class="site-main">
    <?php
    // Get all data from unified admin system
    $content = get_doginvoice_content();
    
    $hero_title = $content['hero_title'] ?? 'Robisz zdjęcie faktury, a reszta dzieje się automatycznie';
    $hero_subtitle = $content['hero_subtitle'] ?? 'DogInvoice automatycznie organizuje Twoje dokumenty, eliminuje chaos administracyjny i pozwala Ci skupić się na tym, co naprawdę ważne.';
    $hero_video_url = $content['hero_video_url'] ?? '/videos/doginvoice_hero.mp4';
    $hero_video_poster = $content['hero_video_poster'] ?? '/doginvoice_hero_frame.png';
    $hero_cta_primary_text = $content['hero_cta_primary_text'] ?? 'Wybierz swój plan';
    $hero_cta_primary_url = $content['hero_cta_primary_url'] ?? '#pricing';
    $hero_cta_secondary_text = $content['hero_cta_secondary_text'] ?? 'Przetestuj za darmo';
    $hero_cta_secondary_url = $content['hero_cta_secondary_url'] ?? '/trial';
    
    $animated_numbers = $content['animated_numbers'] ?? array();
    $process_steps = $content['process_steps'] ?? array();
    $features = $content['features'] ?? array();
    $integrations = $content['integrations'] ?? array();
    $benefits = $content['benefits'] ?? array();
    $pricing_plans = $content['pricing_plans'] ?? array();
    $faq = $content['faq'] ?? array();
    $trusted_by_title = $content['trusted_by_title'] ?? 'Z DogInvoice już korzystają';
    $trusted_by_logos = $content['trusted_by_logos'] ?? array();
    $cta_title = $content['cta_title'] ?? 'Zacznij już dziś';
    $cta_subtitle = $content['cta_subtitle'] ?? 'Dołącz do firm, które oszczędzają 15 godzin tygodniowo dzięki automatyzacji.';
    $cta_primary_text = $content['cta_primary_text'] ?? 'Wybierz swój plan';
    $cta_primary_url = $content['cta_primary_url'] ?? '#pricing';
    $cta_secondary_text = $content['cta_secondary_text'] ?? 'Przetestuj za darmo';
    $cta_secondary_url = $content['cta_secondary_url'] ?? '/trial';
    ?>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title"><?php echo esc_html($hero_title); ?></h1>
                <p class="hero-subtitle"><?php echo esc_html($hero_subtitle); ?></p>
                
                <div class="hero-video">
                    <video class="hero-video-element" autoplay muted loop playsinline webkit-playsinline="true" preload="metadata" poster="<?php echo esc_url($hero_video_poster); ?>">
                        <source src="<?php echo esc_url($hero_video_url); ?>" type="video/mp4">
                        Twoja przeglądarka nie wspiera odtwarzania wideo.
                    </video>
                </div>
                
                <div class="hero-buttons">
                    <a href="<?php echo esc_url($hero_cta_primary_url); ?>" class="btn btn-primary">
                        <?php echo esc_html($hero_cta_primary_text); ?>
                    </a>
                    <a href="<?php echo esc_url($hero_cta_secondary_url); ?>" class="btn btn-secondary">
                        <?php echo esc_html($hero_cta_secondary_text); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Animated Numbers -->
    <?php if (!empty($animated_numbers)): ?>
    <section class="numbers-section">
        <div class="container">
            <div class="numbers-grid">
                <?php foreach ($animated_numbers as $number): ?>
                <div class="number-item">
                    <div class="number-value <?php echo esc_attr($number['color']); ?>">
                        <span class="number"><?php echo esc_html($number['value']); ?></span>
                        <span class="suffix"><?php echo esc_html($number['suffix']); ?></span>
                    </div>
                    <h3 class="number-title"><?php echo esc_html($number['title']); ?></h3>
                    <p class="number-description"><?php echo esc_html($number['description']); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Process Steps -->
    <?php if (!empty($process_steps)): ?>
    <section class="process-section">
        <div class="container">
            <div class="section-header">
                <h2>Jak to działa?</h2>
                <p>Prosty proces w 5 krokach</p>
            </div>
            
            <div class="process-steps">
                <?php foreach ($process_steps as $step): ?>
                <div class="process-step" style="left: <?php echo esc_attr($step['step_position_x']); ?>%; top: <?php echo esc_attr($step['step_position_y']); ?>%;">
                    <div class="step-number"><?php echo esc_html($step['step_number']); ?></div>
                    <div class="step-icon"><?php echo esc_html($step['step_icon']); ?></div>
                    <h3 class="step-title"><?php echo esc_html($step['step_title']); ?></h3>
                    <p class="step-description"><?php echo esc_html($step['step_description']); ?></p>
                    <?php if ($step['step_video_file'] || $step['step_video_url']): ?>
                    <div class="step-video">
                        <video controls>
                            <source src="<?php echo esc_url($step['step_video_file'] ?: $step['step_video_url']); ?>" type="video/mp4">
                        </video>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Features -->
    <?php if (!empty($features)): ?>
    <section class="features-section">
        <div class="container">
            <div class="section-header">
                <h2>Funkcjonalności</h2>
                <p>Wszystko czego potrzebujesz</p>
            </div>
            
            <div class="features-grid">
                <?php foreach ($features as $feature): ?>
                <div class="feature-item">
                    <div class="feature-icon"><?php echo esc_html($feature['feature_icon']); ?></div>
                    <h3 class="feature-title"><?php echo esc_html($feature['feature_title']); ?></h3>
                    <p class="feature-description"><?php echo esc_html($feature['feature_description']); ?></p>
                    <?php if ($feature['feature_highlight']): ?>
                    <div class="feature-highlight"><?php echo esc_html($feature['feature_highlight']); ?></div>
                    <?php endif; ?>
                    <?php if ($feature['feature_video_file'] || $feature['feature_video_url']): ?>
                    <div class="feature-video">
                        <video controls playsinline webkit-playsinline="true" muted preload="metadata">
                            <source src="<?php echo esc_url($feature['feature_video_file'] ?: $feature['feature_video_url']); ?>" type="video/mp4">
                        </video>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Integrations -->
    <?php if (!empty($integrations)): ?>
    <section class="integrations-section">
        <div class="container">
            <div class="section-header">
                <h2>Integracje</h2>
                <p>Łączymy się z Twoimi ulubionymi narzędziami</p>
            </div>
            
            <div class="integrations-grid">
                <?php foreach ($integrations as $integration): ?>
                <div class="integration-item <?php echo $integration['integration_coming_soon'] ? 'coming-soon' : ''; ?>">
                    <img src="<?php echo esc_url($integration['integration_logo']); ?>" alt="<?php echo esc_attr($integration['integration_name']); ?>" class="integration-logo">
                    <h3 class="integration-name"><?php echo esc_html($integration['integration_name']); ?></h3>
                    <?php if ($integration['integration_coming_soon']): ?>
                    <span class="coming-soon-badge">Wkrótce</span>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Benefits -->
    <?php if (!empty($benefits)): ?>
    <section class="benefits-section">
        <div class="container">
            <div class="section-header">
                <h2>Korzyści</h2>
                <p>Dlaczego warto wybrać DogInvoice</p>
            </div>
            
            <div class="benefits-grid">
                <?php foreach ($benefits as $benefit): ?>
                <div class="benefit-item">
                    <div class="benefit-icon"><?php echo esc_html($benefit['benefit_icon']); ?></div>
                    <h3 class="benefit-title"><?php echo esc_html($benefit['benefit_title']); ?></h3>
                    <p class="benefit-description"><?php echo esc_html($benefit['benefit_description']); ?></p>
                    <?php if ($benefit['benefit_highlight']): ?>
                    <div class="benefit-highlight"><?php echo esc_html($benefit['benefit_highlight']); ?></div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Pricing Plans -->
    <?php if (!empty($pricing_plans)): ?>
    <section class="pricing-section" id="pricing">
        <div class="container">
            <div class="section-header">
                <h2>Plany cenowe</h2>
                <p>Wybierz plan dopasowany do Twoich potrzeb</p>
            </div>
            
            <div class="pricing-grid">
                <?php foreach ($pricing_plans as $plan): ?>
                <div class="pricing-plan <?php echo $plan['plan_popular'] ? 'popular' : ''; ?>">
                    <?php if ($plan['plan_popular']): ?>
                    <div class="popular-badge">Popularny</div>
                    <?php endif; ?>
                    
                    <h3 class="plan-name"><?php echo esc_html($plan['plan_name']); ?></h3>
                    <div class="plan-price">
                        <span class="price"><?php echo esc_html($plan['plan_price']); ?></span>
                        <span class="period"><?php echo esc_html($plan['plan_period']); ?></span>
                    </div>
                    
                    <?php if ($plan['plan_description']): ?>
                    <p class="plan-description"><?php echo esc_html($plan['plan_description']); ?></p>
                    <?php endif; ?>
                    
                    <div class="plan-features">
                        <?php 
                        $features_list = is_array($plan['plan_features']) ? $plan['plan_features'] : explode("\n", $plan['plan_features']);
                        foreach ($features_list as $feature_line):
                            $feature_line = trim($feature_line);
                            if ($feature_line):
                        ?>
                        <div class="feature-item"><?php echo esc_html($feature_line); ?></div>
                        <?php 
                            endif;
                        endforeach; 
                        ?>
                    </div>
                    
                    <a href="<?php echo esc_url($plan['plan_cta_url']); ?>" class="plan-cta">
                        <?php echo esc_html($plan['plan_cta_text']); ?>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- FAQ -->
    <?php if (!empty($faq)): ?>
    <section class="faq-section">
        <div class="container">
            <div class="section-header">
                <h2>Często zadawane pytania</h2>
                <p>Odpowiedzi na najważniejsze wątpliwości</p>
            </div>
            
            <div class="faq-list">
                <?php foreach ($faq as $faq_item): ?>
                <div class="faq-item">
                    <h3 class="faq-question"><?php echo esc_html($faq_item['faq_question']); ?></h3>
                    <div class="faq-answer"><?php echo esc_html($faq_item['faq_answer']); ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Trusted By -->
    <?php if (!empty($trusted_by_logos)): ?>
    <section class="trusted-section">
        <div class="container">
            <div class="section-header">
                <h2><?php echo esc_html($trusted_by_title); ?></h2>
            </div>
            
            <div class="trusted-logos">
                <?php foreach ($trusted_by_logos as $logo): ?>
                <div class="trusted-logo">
                    <img src="<?php echo esc_url($logo['image']); ?>" alt="<?php echo esc_attr($logo['name']); ?>" style="height: <?php echo esc_attr($logo['height']); ?>px;">
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2 class="cta-title"><?php echo esc_html($cta_title); ?></h2>
                <p class="cta-subtitle"><?php echo esc_html($cta_subtitle); ?></p>
                
                <div class="cta-buttons">
                    <a href="<?php echo esc_url($cta_primary_url); ?>" class="btn btn-primary">
                        <?php echo esc_html($cta_primary_text); ?>
                    </a>
                    <a href="<?php echo esc_url($cta_secondary_url); ?>" class="btn btn-secondary">
                        <?php echo esc_html($cta_secondary_text); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
