<?php
/**
 * Main template file for DogInvoice WordPress Theme
 */

get_header(); ?>

<div id="app" class="doginvoice-app">
    <!-- Hero Section -->
    <section id="hero" class="hero-section">
        <?php
        $hero_posts = get_posts(array(
            'post_type' => 'doginvoice_hero',
            'posts_per_page' => 1,
            'post_status' => 'publish'
        ));
        
        if (!empty($hero_posts)):
            $hero = $hero_posts[0];
        ?>
            <div class="hero-container">
                <div class="hero-content">
                    <h1 class="hero-title">
                        <?php echo esc_html(get_field('hero_title', $hero->ID) ?: 'Robisz zdjęcie faktury, a reszta dzieje się automatycznie'); ?>
                    </h1>
                    <p class="hero-subtitle">
                        <?php echo esc_html(get_field('hero_subtitle', $hero->ID) ?: 'DogInvoice automatycznie organizuje Twoje dokumenty, eliminuje chaos administracyjny i pozwala Ci skupić się na tym, co naprawdę ważne.'); ?>
                    </p>
                    
                    <div class="hero-cta">
                        <?php if (get_field('hero_cta_primary_text', $hero->ID)): ?>
                            <a href="<?php echo esc_url(get_field('hero_cta_primary_url', $hero->ID) ?: '#pricing'); ?>" class="btn btn-primary">
                                <?php echo esc_html(get_field('hero_cta_primary_text', $hero->ID)); ?>
                            </a>
                        <?php endif; ?>
                        
                        <?php if (get_field('hero_cta_secondary_text', $hero->ID)): ?>
                            <a href="<?php echo esc_url(get_field('hero_cta_secondary_url', $hero->ID) ?: '/trial'); ?>" class="btn btn-secondary">
                                <?php echo esc_html(get_field('hero_cta_secondary_text', $hero->ID)); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                
                <?php if (get_field('hero_video_url', $hero->ID)): ?>
                    <div class="hero-video">
                        <video 
                            autoplay 
                            muted 
                            loop 
                            playsinline
                            poster="<?php echo esc_url(get_field('hero_video_poster', $hero->ID) ?: '/doginvoice_hero_frame.png'); ?>"
                        >
                            <source src="<?php echo esc_url(get_field('hero_video_url', $hero->ID)); ?>" type="video/mp4">
                        </video>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </section>

    <!-- Process Steps Section -->
    <section id="process" class="process-section">
        <div class="container">
            <div class="section-header">
                <h2>Jak to działa?</h2>
                <p>Prosty, zautomatyzowany proces w 5 krokach</p>
            </div>
            
            <div class="process-steps">
                <?php
                $steps = get_posts(array(
                    'post_type' => 'process_steps',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                ));
                
                foreach ($steps as $index => $step):
                    $icon = get_field('step_icon', $step->ID) ?: 'upload';
                    $video_url = get_field('step_video_url', $step->ID);
                    $position_x = get_field('step_position_x', $step->ID) ?: 50;
                    $position_y = get_field('step_position_y', $step->ID) ?: 50;
                ?>
                    <div class="process-step" 
                         data-step="<?php echo $index; ?>"
                         style="left: <?php echo esc_attr($position_x); ?>%; top: <?php echo esc_attr($position_y); ?>%;">
                        
                        <div class="step-circle">
                            <button class="step-play-btn" 
                                    data-video="<?php echo esc_url($video_url); ?>"
                                    title="Zobacz demo: <?php echo esc_attr($step->post_title); ?>">
                                <i class="icon-play"></i>
                            </button>
                        </div>
                        
                        <div class="step-number"><?php echo esc_html(get_field('step_number', $step->ID) ?: sprintf('%02d', $index + 1)); ?></div>
                        
                        <div class="step-content">
                            <div class="step-icon">
                                <i class="icon-<?php echo esc_attr($icon); ?>"></i>
                            </div>
                            <h3><?php echo esc_html($step->post_title); ?></h3>
                            <p><?php echo wp_kses_post($step->post_content); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features-section">
        <div class="container">
            <div class="section-header">
                <h2>Funkcjonalności</h2>
                <p>Wszystko czego potrzebujesz do zarządzania fakturami</p>
            </div>
            
            <div class="features-grid">
                <?php
                $features = get_posts(array(
                    'post_type' => 'features',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                ));
                
                foreach ($features as $feature):
                    $icon = get_field('feature_icon', $feature->ID) ?: 'zap';
                    $video_url = get_field('feature_video_url', $feature->ID);
                    $highlight = get_field('feature_highlight', $feature->ID);
                ?>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="icon-<?php echo esc_attr($icon); ?>"></i>
                        </div>
                        <h3><?php echo esc_html($feature->post_title); ?></h3>
                        <p><?php echo wp_kses_post($feature->post_content); ?></p>
                        <?php if ($highlight): ?>
                            <span class="feature-highlight"><?php echo esc_html($highlight); ?></span>
                        <?php endif; ?>
                        <?php if ($video_url): ?>
                            <button class="feature-video-btn" data-video="<?php echo esc_url($video_url); ?>">
                                <i class="icon-play"></i>
                            </button>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section id="benefits" class="benefits-section">
        <div class="container">
            <div class="section-header">
                <h2>Korzyści</h2>
                <p>Dlaczego warto wybrać DogInvoice</p>
            </div>
            
            <div class="benefits-grid">
                <?php
                $benefits = get_posts(array(
                    'post_type' => 'benefits',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                ));
                
                foreach ($benefits as $benefit):
                    $icon = get_field('benefit_icon', $benefit->ID) ?: 'bot';
                    $highlight = get_field('benefit_highlight', $benefit->ID);
                ?>
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="icon-<?php echo esc_attr($icon); ?>"></i>
                        </div>
                        <h3><?php echo esc_html($benefit->post_title); ?></h3>
                        <p><?php echo wp_kses_post($benefit->post_content); ?></p>
                        <?php if ($highlight): ?>
                            <span class="benefit-highlight"><?php echo esc_html($highlight); ?></span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Integrations Section -->
    <section id="integrations" class="integrations-section">
        <div class="container">
            <div class="section-header">
                <h2>Integracje</h2>
                <p>Połącz DogInvoice z oprogramowaniem, z którego korzystasz na codzień</p>
            </div>
            
            <div class="integrations-grid">
                <?php
                $integrations = get_posts(array(
                    'post_type' => 'integrations',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                ));
                
                foreach ($integrations as $integration):
                    $logo = get_field('integration_logo', $integration->ID);
                    $url = get_field('integration_url', $integration->ID);
                    $coming_soon = get_field('integration_coming_soon', $integration->ID);
                ?>
                    <div class="integration-card <?php echo $coming_soon ? 'coming-soon' : ''; ?>">
                        <?php if ($logo): ?>
                            <div class="integration-logo">
                                <img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr($integration->post_title); ?>">
                            </div>
                        <?php endif; ?>
                        <h3><?php echo esc_html($integration->post_title); ?></h3>
                        <?php if ($integration->post_content): ?>
                            <p><?php echo wp_kses_post($integration->post_content); ?></p>
                        <?php endif; ?>
                        <?php if ($coming_soon): ?>
                            <span class="coming-soon-badge">Wkrótce</span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="pricing-section">
        <div class="container">
            <div class="section-header">
                <h2>Plany cenowe</h2>
                <p>Wybierz plan dopasowany do Twoich potrzeb</p>
            </div>
            
            <div class="pricing-grid">
                <?php
                $plans = get_posts(array(
                    'post_type' => 'pricing_plans',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                ));
                
                foreach ($plans as $plan):
                    $price = get_field('plan_price', $plan->ID);
                    $period = get_field('plan_period', $plan->ID);
                    $features = get_field('plan_features', $plan->ID);
                    $cta_text = get_field('plan_cta_text', $plan->ID) ?: 'Rozpocznij';
                    $cta_url = get_field('plan_cta_url', $plan->ID);
                    $popular = get_field('plan_popular', $plan->ID);
                ?>
                    <div class="pricing-card <?php echo $popular ? 'popular' : ''; ?>">
                        <?php if ($popular): ?>
                            <div class="popular-badge">Popularny</div>
                        <?php endif; ?>
                        
                        <h3><?php echo esc_html($plan->post_title); ?></h3>
                        
                        <div class="pricing-price">
                            <span class="price"><?php echo esc_html($price); ?></span>
                            <span class="period"><?php echo esc_html($period); ?></span>
                        </div>
                        
                        <?php if ($plan->post_content): ?>
                            <p class="plan-description"><?php echo wp_kses_post($plan->post_content); ?></p>
                        <?php endif; ?>
                        
                        <?php if ($features): ?>
                            <ul class="plan-features">
                                <?php 
                                $feature_list = explode("\n", $features);
                                foreach ($feature_list as $feature):
                                    $feature = trim($feature);
                                    if ($feature):
                                ?>
                                    <li><?php echo esc_html($feature); ?></li>
                                <?php 
                                    endif;
                                endforeach; 
                                ?>
                            </ul>
                        <?php endif; ?>
                        
                        <?php if ($cta_url): ?>
                            <a href="<?php echo esc_url($cta_url); ?>" class="btn btn-primary">
                                <?php echo esc_html($cta_text); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="faq-section">
        <div class="container">
            <div class="section-header">
                <h2>Najczęściej zadawane pytania</h2>
                <p>Odpowiedzi na najważniejsze pytania</p>
            </div>
            
            <div class="faq-list">
                <?php
                $faqs = get_posts(array(
                    'post_type' => 'faq',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                ));
                
                foreach ($faqs as $index => $faq):
                ?>
                    <div class="faq-item">
                        <button class="faq-question" data-faq="<?php echo $index; ?>">
                            <span><?php echo esc_html($faq->post_title); ?></span>
                            <i class="icon-chevron-down"></i>
                        </button>
                        <div class="faq-answer">
                            <div class="faq-content">
                                <?php echo wp_kses_post($faq->post_content); ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</div>

<!-- Video Modal -->
<div id="video-modal" class="video-modal">
    <div class="video-modal-content">
        <button class="video-modal-close">&times;</button>
        <video id="modal-video" controls>
            <source src="" type="video/mp4">
        </video>
    </div>
</div>

<?php get_footer(); ?>
