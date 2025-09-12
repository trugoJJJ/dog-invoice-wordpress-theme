<?php
/**
 * The main template file
 * 
 * @package DogInvoice
 */

get_header(); ?>

<style>
/* Exact styles from Next.js project */
:root {
  --font-geist-sans: 'Inter', system-ui, sans-serif;
  --font-geist-mono: 'Inter', monospace;
  --background: 0 0% 98%;
  --foreground: 0 0% 8%;
  --card: 0 0% 100%;
  --card-foreground: 0 0% 8%;
  --popover: 0 0% 100%;
  --popover-foreground: 0 0% 8%;
  --primary: 215 76% 45%;
  --primary-foreground: 0 0% 98%;
  --secondary: 0 0% 92%;
  --secondary-foreground: 0 0% 8%;
  --muted: 0 0% 92%;
  --muted-foreground: 0 0% 45%;
  --accent: 0 0% 88%;
  --accent-foreground: 0 0% 8%;
  --success: 215 76% 45%;
  --success-foreground: 0 0% 98%;
  --destructive: 0 84% 60%;
  --destructive-foreground: 0 0% 98%;
  --border: 0 0% 88%;
  --input: 0 0% 88%;
  --ring: 215 76% 45%;
  --gradient-minimal: linear-gradient(180deg, hsl(0 0% 98%) 0%, hsl(0 0% 95%) 100%);
  --gradient-dark: linear-gradient(135deg, hsl(0 0% 8%) 0%, hsl(0 0% 2%) 100%);
  --gradient-subtle: linear-gradient(180deg, hsl(0 0% 100%) 0%, hsl(0 0% 96%) 100%);
  --gradient-hero: linear-gradient(135deg, hsl(0 0% 8%) 0%, hsl(0 0% 20%) 100%);
  --gradient-glass: linear-gradient(135deg, hsl(0 0% 100% / 0.8) 0%, hsl(0 0% 95% / 0.6) 100%);
  --shadow-minimal: 0 1px 3px 0 hsl(0 0% 0% / 0.08), 0 1px 2px -1px hsl(0 0% 0% / 0.08);
  --shadow-float: 0 10px 25px -3px hsl(0 0% 0% / 0.15), 0 4px 6px -4px hsl(0 0% 0% / 0.15);
  --shadow-elegant: 0 20px 60px -10px hsl(0 0% 0% / 0.25);
  --shadow-hover: 0 25px 50px -12px hsl(0 0% 0% / 0.25);
  --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  --transition-spring: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
  --transition-bounce: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
  --radius: 0.75rem;
}

* { box-sizing: border-box; }
body { 
    font-family: var(--font-geist-sans);
    background-color: hsl(var(--background)); 
    color: hsl(var(--foreground)); 
    line-height: 1.6; 
    margin: 0; 
    padding: 0; 
    font-weight: 400;
}

.container { 
    max-width: 1200px; 
    margin: 0 auto; 
    padding: 0 1rem; 
}

.text-center { text-align: center; }

/* Hero Section - exact from Next.js */
.hero-section { 
    min-height: 50vh; 
    background: var(--gradient-subtle); 
    display: flex; 
    align-items: center; 
    justify-content: center; 
    position: relative; 
    overflow: hidden; 
    padding: 6rem 1rem 2rem; 
}

.hero-title { 
    font-size: 3rem; 
    font-weight: 600; 
    line-height: 1.2; 
    color: hsl(var(--foreground)); 
    margin-bottom: 2rem; 
    text-align: center; 
    text-wrap: balance;
}

.hero-subtitle { 
    font-size: 1.25rem; 
    color: hsl(var(--muted-foreground)); 
    margin-bottom: 2.5rem; 
    text-align: center; 
    max-width: 64rem; 
    margin-left: auto; 
    margin-right: auto; 
    text-wrap: balance;
}

.hero-buttons { 
    display: flex; 
    flex-direction: column; 
    gap: 1rem; 
    justify-content: center; 
    margin-bottom: 3rem; 
}

.btn { 
    display: inline-flex; 
    align-items: center; 
    justify-content: center; 
    border-radius: 0.5rem; 
    font-weight: 500; 
    transition: var(--transition-smooth); 
    text-decoration: none; 
    border: none; 
    outline: none; 
    cursor: pointer; 
    padding: 0.75rem 1.5rem; 
    font-size: 1rem; 
}

.btn-primary { 
    background-color: hsl(var(--primary)); 
    color: hsl(var(--primary-foreground)); 
}

.btn-primary:hover { 
    background-color: hsl(var(--primary) / 0.9); 
}

.btn-secondary { 
    background-color: transparent; 
    color: hsl(var(--foreground)); 
    border: 1px solid hsl(var(--primary)); 
}

.btn-secondary:hover { 
    background-color: hsl(var(--primary)); 
    color: hsl(var(--primary-foreground)); 
}

/* CTA Section */
.cta-section { 
    padding: 5rem 0; 
    background-color: hsl(var(--background)); 
}

.cta-title { 
    font-size: 2.25rem; 
    font-weight: 600; 
    color: hsl(var(--foreground)); 
    margin-bottom: 1.5rem; 
    text-align: center; 
}

.cta-subtitle { 
    font-size: 1.25rem; 
    color: hsl(var(--muted-foreground)); 
    margin-bottom: 2rem; 
    text-align: center; 
    line-height: 1.625; 
    max-width: 64rem; 
    margin-left: auto; 
    margin-right: auto; 
    text-wrap: balance;
}

.cta-buttons { 
    display: flex; 
    flex-direction: column; 
    gap: 1rem; 
    justify-content: center; 
}

.cta-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    font-weight: 500;
    transition: var(--transition-smooth);
    text-decoration: none;
    border: none;
    outline: none;
    cursor: pointer;
}

.cta-button-primary {
    background-color: transparent;
    color: hsl(var(--foreground));
    border: 1px solid hsl(var(--primary));
}

.cta-button-primary:hover {
    background-color: hsl(var(--primary));
    color: hsl(var(--primary-foreground));
}

.cta-button-secondary {
    background-color: hsl(var(--primary));
    color: hsl(var(--primary-foreground));
}

.cta-button-secondary:hover {
    background-color: hsl(var(--primary) / 0.9);
}

/* Responsive */
@media (min-width: 640px) {
    .hero-buttons { flex-direction: row; }
    .cta-buttons { flex-direction: row; }
}

/* Additional sections styles */
.py-20 { padding: 5rem 0; }
.py-16 { padding: 4rem 0; }
.py-40 { padding: 10rem 0; }
.lg\:py-40 { padding: 10rem 0; }
.lg\:py-32 { padding: 8rem 0; }

.bg-muted\/30 { background-color: hsl(var(--muted) / 0.3); }
.bg-background { background-color: hsl(var(--background)); }
.border-border { border-color: hsl(var(--border)); }

.container { max-width: 1200px; margin: 0 auto; padding: 0 1rem; }
.mx-auto { margin-left: auto; margin-right: auto; }
.px-4 { padding-left: 1rem; padding-right: 1rem; }

.text-center { text-align: center; }
.mb-16 { margin-bottom: 4rem; }
.mb-20 { margin-bottom: 5rem; }
.mb-24 { margin-bottom: 6rem; }
.lg\:mb-24 { margin-bottom: 6rem; }

.text-4xl { font-size: 2.25rem; line-height: 2.5rem; }
.font-semibold { font-weight: 600; }
.text-foreground { color: hsl(var(--foreground)); }
.mb-6 { margin-bottom: 1.5rem; }
.tracking-tight { letter-spacing: -0.025em; }
.lg\:text-5xl { font-size: 3rem; line-height: 1; }

.text-lg { font-size: 1.125rem; line-height: 1.75rem; }
.text-muted-foreground { color: hsl(var(--muted-foreground)); }
.max-w-2xl { max-width: 42rem; }
.mx-auto { margin-left: auto; margin-right: auto; }
.font-light { font-weight: 300; }
.lg\:text-xl { font-size: 1.25rem; line-height: 1.75rem; }

.space-y-24 > * + * { margin-top: 6rem; }
.lg\:space-y-32 > * + * { margin-top: 8rem; }

.grid { display: grid; }
.lg\:grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
.gap-8 { gap: 2rem; }
.lg\:gap-12 { gap: 3rem; }
.items-center { align-items: center; }

.space-y-6 > * + * { margin-top: 1.5rem; }
.lg\:space-y-8 > * + * { margin-top: 2rem; }
.max-w-\[500px\] { max-width: 500px; }
.text-center { text-align: center; }
.lg\:mx-0 { margin-left: 0; margin-right: 0; }
.lg\:text-left { text-align: left; }
.lg\:text-right { text-align: right; }
.lg\:ml-auto { margin-left: auto; }

.flex { display: flex; }
.items-center { align-items: center; }
.gap-4 { gap: 1rem; }
.justify-center { justify-content: center; }
.lg\:justify-start { justify-content: flex-start; }
.lg\:justify-end { justify-content: flex-end; }

.hidden { display: none; }
.lg\:flex { display: flex; }
.w-12 { width: 3rem; }
.h-12 { height: 3rem; }
.rounded-full { border-radius: 9999px; }
.bg-muted { background-color: hsl(var(--muted)); }
.items-center { align-items: center; }
.justify-center { justify-content: center; }

.text-2xl { font-size: 1.5rem; line-height: 2rem; }
.font-medium { font-weight: 500; }
.text-foreground { color: hsl(var(--foreground)); }
.lg\:text-3xl { font-size: 1.875rem; line-height: 2.25rem; }

.text-muted-foreground { color: hsl(var(--muted-foreground)); }
.leading-relaxed { line-height: 1.625; }
.font-light { font-weight: 300; }
.text-lg { font-size: 1.125rem; line-height: 1.75rem; }
.lg\:text-xl { font-size: 1.25rem; line-height: 1.75rem; }

.relative { position: relative; }
.mx-auto { margin-left: auto; margin-right: auto; }
.transition-all { transition: var(--transition-smooth); }
.duration-500 { transition-duration: 500ms; }
.ease-out { transition-timing-function: cubic-bezier(0, 0, 0.2, 1); }

.bg-card { background-color: hsl(var(--card)); }
.shadow-sm { box-shadow: var(--shadow-minimal); }
.rounded-2xl { border-radius: 1rem; }
.p-3 { padding: 0.75rem; }

.overflow-hidden { overflow: hidden; }
.bg-gradient-minimal { background: var(--gradient-minimal); }
.rounded-xl { border-radius: 0.75rem; }

.aspect-\[16\/9\] { aspect-ratio: 16/9; }

.w-full { width: 100%; }
.h-full { height: 100%; }
.object-cover { object-fit: cover; }
.rounded-lg { border-radius: 0.5rem; }
.muted { }
.playsinline { }
.loop { }
.preload-metadata { }

@media (min-width: 1024px) {
    .hero-title { font-size: 3.75rem; }
    .hero-subtitle { font-size: 1.5rem; }
    .cta-title { font-size: 3rem; }
}
</style>

<main id="main" class="site-main">
        <?php
    // Get Hero section data
        $hero_posts = get_posts(array(
        'post_type' => 'dog_hero',
            'posts_per_page' => 1,
            'post_status' => 'publish'
        ));
        
    if ($hero_posts) {
        $hero_post = $hero_posts[0];
        $hero_title = get_field('hero_title', $hero_post->ID) ?: 'Robisz zdjęcie faktury, a reszta dzieje się automatycznie';
        $hero_subtitle = get_field('hero_subtitle', $hero_post->ID) ?: 'DogInvoice automatycznie organizuje Twoje dokumenty, eliminuje chaos administracyjny i pozwala Ci skupić się na tym, co naprawdę ważne.';
        $hero_video_file = get_field('hero_video_file', $hero_post->ID);
        $hero_video_url = get_field('hero_video_url', $hero_post->ID);
        $hero_video_url = $hero_video_file ?: $hero_video_url ?: '/videos/doginvoice_hero.mp4';
        $hero_video_poster = get_field('hero_video_poster', $hero_post->ID) ?: '/doginvoice_hero_frame.png';
        $hero_cta_primary_text = get_field('hero_cta_primary_text', $hero_post->ID) ?: 'Wybierz swój plan';
        $hero_cta_primary_url = get_field('hero_cta_primary_url', $hero_post->ID) ?: '#pricing';
        $hero_cta_secondary_text = get_field('hero_cta_secondary_text', $hero_post->ID) ?: 'Przetestuj za darmo';
        $hero_cta_secondary_url = get_field('hero_cta_secondary_url', $hero_post->ID) ?: '/trial';
        $animated_numbers = get_field('animated_numbers', $hero_post->ID) ?: array();
        $trusted_by_title = get_field('trusted_by_title', $hero_post->ID) ?: 'Z DogInvoice już korzystają';
        $trusted_by_logos = get_field('trusted_by_logos', $hero_post->ID) ?: array();
        $trial_title = get_field('trial_title', $hero_post->ID) ?: 'Jak działa darmowy plan Starter?';
        $trial_subtitle = get_field('trial_subtitle', $hero_post->ID) ?: 'Rozpocznij bez ryzyka i przekonaj się, jak DogInvoice zmieni Twój sposób pracy.';
        $trial_steps = get_field('trial_steps', $hero_post->ID) ?: array();
        $cta_title = get_field('cta_title', $hero_post->ID) ?: 'Zacznij już dziś';
        $cta_subtitle = get_field('cta_subtitle', $hero_post->ID) ?: 'Dołącz do firm, które oszczędzają 15 godzin tygodniowo dzięki automatyzacji.';
        $cta_primary_text = get_field('cta_primary_text', $hero_post->ID) ?: 'Wybierz swój plan';
        $cta_primary_url = get_field('cta_primary_url', $hero_post->ID) ?: '#pricing';
        $cta_secondary_text = get_field('cta_secondary_text', $hero_post->ID) ?: 'Przetestuj za darmo';
        $cta_secondary_url = get_field('cta_secondary_url', $hero_post->ID) ?: '/trial';
    } else {
        // Fallback values if no hero post exists
        $hero_title = 'Robisz zdjęcie faktury, a reszta dzieje się automatycznie';
        $hero_subtitle = 'DogInvoice automatycznie organizuje Twoje dokumenty, eliminuje chaos administracyjny i pozwala Ci skupić się na tym, co naprawdę ważne.';
        $hero_video_url = '/videos/doginvoice_hero.mp4';
        $hero_video_poster = '/doginvoice_hero_frame.png';
        $hero_cta_primary_text = 'Wybierz swój plan';
        $hero_cta_primary_url = '#pricing';
        $hero_cta_secondary_text = 'Przetestuj za darmo';
        $hero_cta_secondary_url = '/trial';
        $animated_numbers = array();
        $trusted_by_title = 'Z DogInvoice już korzystają';
        $trusted_by_logos = array();
        $trial_title = 'Jak działa darmowy plan Starter?';
        $trial_subtitle = 'Rozpocznij bez ryzyka i przekonaj się, jak DogInvoice zmieni Twój sposób pracy.';
        $trial_steps = array();
        $cta_title = 'Zacznij już dziś';
        $cta_subtitle = 'Dołącz do firm, które oszczędzają 15 godzin tygodniowo dzięki automatyzacji.';
        $cta_primary_text = 'Wybierz swój plan';
        $cta_primary_url = '#pricing';
        $cta_secondary_text = 'Przetestuj za darmo';
        $cta_secondary_url = '/trial';
    }
    ?>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
                    <h1 class="hero-title">
                <?php echo esc_html($hero_title); ?>
                    </h1>
                    <p class="hero-subtitle">
                <?php echo esc_html($hero_subtitle); ?>
            </p>
            <div class="hero-buttons">
                <a href="<?php echo esc_url($hero_cta_primary_url); ?>" class="btn btn-secondary">
                    <?php echo esc_html($hero_cta_primary_text); ?>
                </a>
                <a href="<?php echo esc_url($hero_cta_secondary_url); ?>" class="btn btn-primary">
                    <?php echo esc_html($hero_cta_secondary_text); ?>
                </a>
                </div>
                
                <!-- Hero Video -->
                <div class="relative mx-auto transition-all duration-500 ease-out mb-6 sm:mb-8 max-w-[60rem]">
                    <div class="transition-all duration-500 ease-out bg-card border border-border shadow-elegant rounded-2xl p-3">
                        <div class="relative overflow-hidden bg-background transition-all duration-500 ease-out rounded-xl">
                            <div class="relative transition-all duration-500 ease-out aspect-[16/9]">
                                <video class="w-full h-full object-cover transition-all duration-500 ease-out rounded-lg" autoplay muted loop playsinline preload="metadata" poster="<?php echo esc_url($hero_video_poster); ?>">
                                    <source src="<?php echo esc_url($hero_video_url); ?>" type="video/mp4">
                                    Twoja przeglądarka nie wspiera odtwarzania wideo.
                        </video>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Background elements -->
        <div class="absolute bottom-0 left-0 right-0 h-20 sm:h-80 bg-gradient-to-t from-background via-background/90 to-transparent z-20 transition-opacity duration-300 pointer-events-none" aria-hidden="true"></div>
        <div class="absolute inset-0 opacity-5 pointer-events-none" aria-hidden="true">
            <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-primary rounded-full blur-3xl animate-float"></div>
            <div class="absolute bottom-1/4 right-1/4 w-64 h-64 bg-orange-500 rounded-full blur-3xl animate-float" style="animation-delay: 3s;"></div>
        </div>
    </section>

    <!-- Animated Numbers Section -->
    <?php if (!empty($animated_numbers)): ?>
    <section class="pt-0 pb-20 lg:pb-40 bg-background border-border overflow-hidden">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 max-w-4xl mx-auto">
                <?php foreach ($animated_numbers as $index => $number): ?>
                <div class="text-center group">
                    <div class="mb-6 relative">
                        <div class="text-6xl lg:text-7xl font-medium <?php echo esc_attr($number['color']); ?> mb-2 transition-all duration-300 ease-spring">
                            <?php echo esc_html($number['value']); ?><?php echo esc_html($number['suffix']); ?>
                        </div>
                    </div>
                    <h3 class="mb-2"><?php echo esc_html($number['title']); ?></h3>
                    <p class="text-muted-foreground">
                        <?php echo esc_html($number['description']); ?>
                    </p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>
            
    <!-- Features Section -->
                <?php
    $features_posts = get_posts(array(
        'post_type' => 'dog_features',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                ));
    ?>
    <?php if ($features_posts): ?>
    <section class="py-20 lg:py-40 bg-muted/30">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16 lg:mb-24">
                <h2 class="text-4xl font-semibold text-foreground mb-6 tracking-tight lg:text-5xl">
                    Zmień sposób zarządzania finansami
                </h2>
                <p class="text-lg text-muted-foreground max-w-2xl mx-auto font-light lg:text-xl">
                    Poznaj trzy fundamenty, które poprawią wydajność pracy księgowej.
                </p>
            </div>

            <div class="space-y-24 lg:space-y-32">
                <?php foreach ($features_posts as $index => $feature_post): ?>
                <?php
                $feature_title = get_field('feature_title', $feature_post->ID);
                $feature_description = get_field('feature_description', $feature_post->ID);
                $feature_video_url = get_field('feature_video_url', $feature_post->ID);
                $feature_poster = get_field('feature_poster', $feature_post->ID);
                $feature_icon = get_field('feature_icon', $feature_post->ID);
                ?>
                <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                    <div class="space-y-6 lg:space-y-8 max-w-[500px] text-center mx-auto lg:mx-0 <?php echo $index === 1 ? 'lg:text-left' : 'lg:text-right lg:ml-auto'; ?> <?php echo $index % 2 === 1 ? 'lg:order-2' : ''; ?>">
                        <div class="flex items-center gap-4 justify-center <?php echo $index === 1 ? 'lg:justify-start' : 'lg:justify-end'; ?>">
                            <?php if ($index === 1): ?>
                                <div class="hidden lg:flex w-12 h-12 rounded-full bg-muted items-center justify-center">
                                    <span class="text-muted-foreground"><?php echo esc_html($feature_icon); ?></span>
                                </div>
                                <h3 class="text-2xl font-medium text-foreground lg:text-3xl">
                                    <?php echo esc_html($feature_title); ?>
                                </h3>
                            <?php else: ?>
                                <h3 class="text-2xl font-medium text-foreground lg:text-3xl">
                                    <?php echo esc_html($feature_title); ?>
                                </h3>
                                <div class="hidden lg:flex w-12 h-12 rounded-full bg-muted items-center justify-center">
                                    <span class="text-muted-foreground"><?php echo esc_html($feature_icon); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <p class="text-muted-foreground leading-relaxed font-light text-lg lg:text-xl">
                            <?php echo esc_html($feature_description); ?>
                        </p>
                    </div>
                    <div class="<?php echo $index % 2 === 1 ? 'lg:order-1' : ''; ?>">
                        <div class="relative mx-auto transition-all duration-500 ease-out">
                            <div class="transition-all duration-500 ease-out bg-card shadow-sm rounded-2xl p-3">
                                <div class="relative overflow-hidden bg-gradient-minimal transition-all duration-500 ease-out rounded-xl">
                                    <div class="relative transition-all duration-500 ease-out aspect-[16/9]">
                                        <video src="<?php echo esc_url($feature_video_url); ?>" poster="<?php echo esc_url($feature_poster); ?>" class="w-full h-full object-cover transition-all duration-500 ease-out rounded-lg" muted playsinline loop preload="metadata"></video>
            </div>
        </div>
                            </div>
                        </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Pricing Section -->
                <?php
    $pricing_posts = get_posts(array(
        'post_type' => 'dog_pricing',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                ));
    ?>
    <?php if ($pricing_posts): ?>
    <section id="pricing" class="py-20 lg:py-40 bg-background">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-semibold text-foreground mb-6 tracking-tight lg:text-5xl">
                    Prosty cennik
                </h2>
                <p class="text-xl text-muted-foreground max-w-2xl mx-auto">
                    Wybierz plan idealny dla Twojej firmy.
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 max-w-7xl mx-auto">
                <?php foreach ($pricing_posts as $pricing_post): ?>
                <?php
                $pricing_name = get_field('pricing_name', $pricing_post->ID);
                $pricing_description = get_field('pricing_description', $pricing_post->ID);
                $pricing_price = get_field('pricing_price', $pricing_post->ID);
                $pricing_invoices = get_field('pricing_invoices', $pricing_post->ID);
                $pricing_button_text = get_field('pricing_button_text', $pricing_post->ID);
                $pricing_button_url = get_field('pricing_button_url', $pricing_post->ID);
                $pricing_is_popular = get_field('pricing_is_popular', $pricing_post->ID);
                ?>
                <div class="relative h-full border-2 transition-all duration-300 ease-in-out <?php echo $pricing_is_popular ? 'border-primary shadow-primary/20 shadow-lg' : 'border-border'; ?> hover:scale-105 hover:border-primary/50 rounded-lg">
                    <?php if ($pricing_is_popular): ?>
                    <div class="absolute -top-4 left-1/2 -translate-x-1/2 z-20">
                        <span class="bg-primary text-primary-foreground px-4 py-1 rounded-full text-sm font-medium">
                            Najpopularniejszy
                        </span>
                    </div>
                    <?php endif; ?>
                    <div class="p-8 h-full flex flex-col">
                        <div class="flex-grow">
                            <div class="text-center mb-4">
                                <h3 class="text-2xl font-semibold mb-2">
                                    <?php echo esc_html($pricing_name); ?>
                                </h3>
                                <p class="text-muted-foreground mb-4 h-10">
                                    <?php echo esc_html($pricing_description); ?>
                                </p>
                                <div class="mb-4 min-h-[82px] flex flex-col justify-start items-center">
                                    <?php if ($pricing_price === null || $pricing_price === ''): ?>
                                        <span class="text-2xl font-bold">
                                            Wycena indywidualna
                                        </span>
                                    <?php else: ?>
                                        <div>
                                            <span class="text-4xl font-bold">
                                                <?php echo esc_html($pricing_price); ?> zł
                                            </span>
                                            <span class="text-muted-foreground ml-2">
                                                / miesięcznie
                                            </span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div>
                            <p class="text-center text-sm text-muted-foreground font-medium mb-6">
                                <?php echo esc_html($pricing_invoices); ?>
                            </p>
                            <div>
                                <a href="<?php echo esc_url($pricing_button_url); ?>" class="w-full block text-center px-4 py-2 rounded-lg transition-all duration-300 <?php echo $pricing_is_popular ? 'bg-primary text-primary-foreground hover:bg-primary/90' : 'border border-border hover:bg-muted'; ?>">
                                    <?php echo esc_html($pricing_button_text); ?>
                                </a>
                            </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Benefits Section -->
                <?php
    $benefits_posts = get_posts(array(
        'post_type' => 'dog_benefits',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                ));
    ?>
    <?php if ($benefits_posts): ?>
    <section class="py-20 lg:py-40 bg-background border-border overflow-hidden">
        <div class="container mx-auto">
            <div class="text-center mb-20">
                <h2 class="text-4xl font-semibold text-foreground mb-6 tracking-tight lg:text-5xl">
                    Funkcjonalności automatyzujące <br/>pracę księgowości
                </h2>
                <p class="text-xl text-muted-foreground max-w-2xl mx-auto">
                    Poznaj główne zalety naszego systemu.
                </p>
            </div>
        </div>

        <div class="relative">
            <div class="flex overflow-x-auto gap-4 pl-4 pb-4">
                <?php foreach ($benefits_posts as $benefit_post): ?>
                <?php
                $benefit_title = get_field('benefit_title', $benefit_post->ID);
                $benefit_description = get_field('benefit_description', $benefit_post->ID);
                $benefit_highlight = get_field('benefit_highlight', $benefit_post->ID);
                $benefit_icon = get_field('benefit_icon', $benefit_post->ID);
                ?>
                <div class="flex-shrink-0 w-[480px]">
                    <div class="border-none bg-card h-full rounded-lg">
                        <div class="p-10 relative h-full">
                            <span class="text-xs font-medium mb-6 inline-block px-3 py-1 border border-border rounded-full">
                                <?php echo esc_html($benefit_highlight); ?>
                            </span>
                            <h3 class="mb-4 text-l font-semibold pr-20"><?php echo esc_html($benefit_title); ?></h3>
                            <p class="text-muted-foreground leading-relaxed text-s font-normal pr-20">
                                <?php echo esc_html($benefit_description); ?>
                            </p>
                            <div class="absolute bottom-10 right-10">
                                <div class="bg-card-foreground text-card rounded-full w-10 h-10 flex items-center justify-center">
                                    <span class="text-lg"><?php echo esc_html($benefit_icon); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Process Section -->
                <?php
    $process_posts = get_posts(array(
        'post_type' => 'dog_process',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                ));
    ?>
    <?php if ($process_posts): ?>
    <section class="py-16 lg:py-32 bg-muted/30 from-background via-primary/5 to-background overflow-hidden">
        <div class="container mx-auto px-4">
            <div class="text-center mb-8 relative z-10">
                <h2 class="text-4xl font-semibold text-foreground mb-6 tracking-tight lg:text-5xl">
                    Jak to działa?
                </h2>
                <p class="text-xl text-muted-foreground max-w-2xl mx-auto">
                    Prosty, zautomatyzowany proces w <?php echo count($process_posts); ?> krokach
                </p>
            </div>

            <!-- Mobile Layout -->
            <div class="md:hidden space-y-8">
                <?php foreach ($process_posts as $index => $process_post): ?>
                <?php
                $process_title = get_field('process_title', $process_post->ID);
                $process_description = get_field('process_description', $process_post->ID);
                $process_video_url = get_field('process_video_url', $process_post->ID);
                $process_icon = get_field('process_icon', $process_post->ID);
                ?>
                <div class="text-center">
                    <div class="relative mb-8 w-24 mx-auto">
                        <div class="w-20 h-20 mx-auto rounded-2xl flex items-center justify-center mb-6 transition-spring bg-muted">
                            <span class="text-2xl"><?php echo esc_html($process_icon); ?></span>
                        </div>
                        <div class="absolute -top-2 -left-0 w-8 h-8 text-white rounded-full flex items-center justify-center text-sm font-medium bg-gray-700">
                            <?php echo str_pad($index + 1, 2, '0', STR_PAD_LEFT); ?>
                            </div>
                    </div>
                    <h3 class="text-xl font-medium mb-4 text-balance">
                        <?php echo esc_html($process_title); ?>
                    </h3>
                    <p class="text-muted-foreground text-balance leading-relaxed">
                        <?php echo esc_html($process_description); ?>
                    </p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Integrations Section -->
                <?php
    $integrations_posts = get_posts(array(
        'post_type' => 'dog_integrations',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                ));
    ?>
    <?php if ($integrations_posts): ?>
    <section class="py-20 lg:py-40 bg-muted/30">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-4xl font-semibold text-foreground mb-6 tracking-tight lg:text-5xl">
                    Gotowe integracje
                </h2>
                <p class="text-xl text-muted-foreground max-w-2xl mx-auto">
                    Połącz DogInvoice z oprogramowaniem, z którego korzystasz na co dzień.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 gap-8 justify-center max-w-7xl mx-auto">
                <?php foreach ($integrations_posts as $integration_post): ?>
                <?php
                $integration_title = get_field('integration_title', $integration_post->ID);
                $integration_logo = get_field('integration_logo', $integration_post->ID);
                $integration_coming_soon = get_field('integration_coming_soon', $integration_post->ID);
                ?>
                <div class="relative group text-center transition-all duration-300 mx-auto <?php echo $integration_coming_soon ? 'opacity-50 hover:opacity-100' : ''; ?>">
                    <div class="w-72 h-32 mx-auto rounded-2xl flex items-center justify-center mb-6 bg-background border border-slate-200 dark:border-slate-800 p-4 transition-all duration-300">
                        <?php if ($integration_logo): ?>
                        <img src="<?php echo esc_url($integration_logo); ?>" alt="<?php echo esc_attr($integration_title); ?>" class="max-w-full transition-all duration-300 group-hover:scale-110 dark:grayscale dark:invert h-[35px] <?php echo $integration_coming_soon ? 'grayscale' : ''; ?>">
                        <?php endif; ?>
                        </div>
                        
                    <?php if ($integration_coming_soon): ?>
                    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-72 h-32 rounded-2xl flex items-center justify-center bg-white/90 dark:bg-black/90 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                        <p class="text-sm font-semibold text-[#1c64ca]">
                            pracujemy nad tym
                        </p>
                    </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- FAQ Section -->
                <?php
    $faq_posts = get_posts(array(
        'post_type' => 'dog_faq',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                ));
    ?>
    <?php if ($faq_posts): ?>
    <section class="py-16 lg:py-32 bg-muted/30 border-border">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-semibold text-foreground mb-6 tracking-tight lg:text-5xl">
                    Często zadawane pytania
                </h2>
                <p class="text-xl text-muted-foreground max-w-2xl mx-auto">
                    Odpowiedzi na najważniejsze wątpliwości.
                </p>
            </div>

            <div class="max-w-3xl mx-auto">
                <div class="space-y-4">
                    <?php foreach ($faq_posts as $index => $faq_post): ?>
                    <?php
                    $faq_question = get_field('faq_question', $faq_post->ID);
                    $faq_answer = get_field('faq_answer', $faq_post->ID);
                    ?>
                    <div class="border border-border rounded-lg px-6 bg-background shadow-minimal transition-all duration-300 ease-spring">
                        <div class="py-6">
                            <h3 class="text-lg text-foreground hover:text-primary transition-all duration-300 ease-spring cursor-pointer">
                                <?php echo esc_html($faq_question); ?>
                            </h3>
                            <div class="text-muted-foreground leading-relaxed pb-6 mt-4">
                                <?php echo esc_html($faq_answer); ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Trusted By Section -->
    <?php if (!empty($trusted_by_logos)): ?>
    <section class="py-20 lg:py-40 bg-background">
        <div class="container mx-auto px-4">
            <h2 class="text-center text-xl font-regular text-foreground tracking-wider mb-20">
                <?php echo esc_html($trusted_by_title); ?>
            </h2>
            
            <div class="flex flex-wrap justify-center items-center gap-x-16 gap-y-12 lg:gap-x-32 lg:gap-y-16">
                <?php foreach ($trusted_by_logos as $logo): ?>
                <a href="<?php echo esc_url($logo['url']); ?>" target="_blank" rel="noopener noreferrer nofollow" aria-label="Odwiedź stronę <?php echo esc_attr($logo['name']); ?>" class="text-black dark:text-white hover:text-[#1c64ca] dark:hover:text-[#1c64ca] transition-colors duration-300">
                    <img src="<?php echo esc_url($logo['image']); ?>" alt="<?php echo esc_attr($logo['name']); ?>" class="<?php echo esc_attr($logo['height']); ?>px w-auto">
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Trial Section -->
    <?php if (!empty($trial_steps)): ?>
    <section class="py-40 bg-muted/30">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-4xl mx-auto mb-20">
                <h2 class="text-4xl font-semibold text-foreground mb-6 tracking-tight lg:text-5xl">
                    <?php echo esc_html($trial_title); ?>
                </h2>
                <p class="text-xl text-muted-foreground text-balance">
                    <?php echo esc_html($trial_subtitle); ?>
                </p>
</div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 max-w-6xl mx-auto">
                <?php foreach ($trial_steps as $index => $step): ?>
                <div class="text-center">
                    <div class="relative mb-8 w-24 mx-auto">
                        <div class="w-20 h-20 mx-auto rounded-2xl flex items-center justify-center mb-6 transition-spring bg-muted">
                            <span class="text-2xl"><?php echo esc_html($step['icon']); ?></span>
                        </div>
                        <div class="absolute -top-2 -left-0 w-8 h-8 text-white rounded-full flex items-center justify-center text-sm font-medium bg-gray-700">
                            <?php echo $index + 1; ?>
    </div>
</div>
                    
                    <h3 class="text-xl font-medium mb-4 text-balance">
                        <?php echo esc_html($step['title']); ?>
                    </h3>
                    
                    <p class="text-muted-foreground text-balance leading-relaxed">
                        <?php echo esc_html($step['description']); ?>
                    </p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- CTA Section -->
    <div class="cta-section">
        <div class="container">
            <div class="text-center">
                <h2 class="cta-title"><?php echo esc_html($cta_title); ?></h2>
                <p class="cta-subtitle">
                    <?php echo esc_html($cta_subtitle); ?>
                </p>
                <div class="cta-buttons">
                    <a href="<?php echo esc_url($cta_primary_url); ?>" class="cta-button cta-button-primary">
                        <?php echo esc_html($cta_primary_text); ?>
                    </a>
                    <a href="<?php echo esc_url($cta_secondary_url); ?>" class="cta-button cta-button-secondary">
                        <?php echo esc_html($cta_secondary_text); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>

</main>

<?php get_footer(); ?>