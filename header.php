<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <!-- Preconnect to external domains -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/images/apple-touch-icon.png">
    
    <!-- Meta Tags -->
    <meta name="description" content="<?php echo get_bloginfo('description'); ?>">
    <meta name="keywords" content="faktury, automatyzacja, AI, księgowość, finanse">
    <meta name="author" content="DogInvoice">
    
    <!-- Open Graph -->
    <meta property="og:title" content="<?php wp_title('|', true, 'right'); bloginfo('name'); ?>">
    <meta property="og:description" content="<?php echo get_bloginfo('description'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo home_url(); ?>">
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/assets/images/og-image.jpg">
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php wp_title('|', true, 'right'); bloginfo('name'); ?>">
    <meta name="twitter:description" content="<?php echo get_bloginfo('description'); ?>">
    <meta name="twitter:image" content="<?php echo get_template_directory_uri(); ?>/assets/images/og-image.jpg">
    
    <!-- Theme Color -->
    <meta name="theme-color" content="#f97316">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="<?php echo home_url($_SERVER['REQUEST_URI']); ?>">
    
    <!-- RSS Feed -->
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>">
    
    <?php wp_head(); ?>
    
    <!-- Custom CSS Variables -->
    <style>
        :root {
            --primary: 27 87% 53%;
            --primary-foreground: 0 0% 100%;
            --secondary: 210 40% 98%;
            --secondary-foreground: 222.2 84% 4.9%;
            --muted: 210 40% 96%;
            --muted-foreground: 215.4 16.3% 46.9%;
            --accent: 210 40% 98%;
            --accent-foreground: 222.2 84% 4.9%;
            --destructive: 0 84.2% 60.2%;
            --destructive-foreground: 210 40% 98%;
            --border: 214.3 31.8% 91.4%;
            --input: 214.3 31.8% 91.4%;
            --ring: 27 87% 53%;
            --background: 0 0% 100%;
            --foreground: 222.2 84% 4.9%;
            --card: 0 0% 100%;
            --card-foreground: 222.2 84% 4.9%;
            --popover: 0 0% 100%;
            --popover-foreground: 222.2 84% 4.9%;
            --radius: 0.5rem;
        }
        
        .dark {
            --primary: 27 87% 53%;
            --primary-foreground: 0 0% 100%;
            --secondary: 222.2 84% 4.9%;
            --secondary-foreground: 210 40% 98%;
            --muted: 222.2 84% 4.9%;
            --muted-foreground: 215 20.2% 65.1%;
            --accent: 222.2 84% 4.9%;
            --accent-foreground: 210 40% 98%;
            --destructive: 0 62.8% 30.6%;
            --destructive-foreground: 210 40% 98%;
            --border: 222.2 84% 4.9%;
            --input: 222.2 84% 4.9%;
            --ring: 27 87% 53%;
            --background: 222.2 84% 4.9%;
            --foreground: 210 40% 98%;
            --card: 222.2 84% 4.9%;
            --card-foreground: 210 40% 98%;
            --popover: 222.2 84% 4.9%;
            --popover-foreground: 210 40% 98%;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
    </style>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    
    <!-- Navigation -->
    <header class="site-header">
        <nav class="main-navigation">
            <div class="container">
                <div class="nav-content">
                    <!-- Logo -->
                    <div class="nav-logo">
                        <a href="<?php echo home_url(); ?>" class="logo-link">
                            <?php 
                            $site_logo = get_field('site_logo', 'option');
                            if ($site_logo): ?>
                                <img src="<?php echo esc_url($site_logo); ?>" alt="<?php bloginfo('name'); ?>" class="logo-image">
                            <?php else: ?>
                                <span class="logo-text"><?php bloginfo('name'); ?></span>
                            <?php endif; ?>
                        </a>
                    </div>
                    
                    <!-- Desktop Menu -->
                    <div class="nav-menu desktop-menu">
                        <ul class="nav-list">
                            <li><a href="#features">Funkcjonalności</a></li>
                            <li><a href="#process">Jak to działa</a></li>
                            <li><a href="#integrations">Integracje</a></li>
                            <li><a href="#pricing">Cennik</a></li>
                            <li><a href="#faq">FAQ</a></li>
                        </ul>
                    </div>
                    
                    <!-- CTA Buttons -->
                    <div class="nav-actions">
                        <button class="theme-toggle" aria-label="Toggle theme">
                            <span class="theme-icon">🌙</span>
                        </button>
                        <a href="/trial" class="btn btn-outline">Przetestuj za darmo</a>
                        <a href="https://app.doginvoice.com" class="btn btn-primary" target="_blank" rel="noopener">Zaloguj się</a>
                    </div>
                    
                    <!-- Mobile Menu Toggle -->
                    <button class="mobile-menu-toggle" aria-label="Toggle mobile menu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Menu -->
            <div class="mobile-menu">
                <div class="mobile-menu-content">
                    <ul class="mobile-nav-list">
                        <li><a href="#features">Funkcjonalności</a></li>
                        <li><a href="#process">Jak to działa</a></li>
                        <li><a href="#integrations">Integracje</a></li>
                        <li><a href="#pricing">Cennik</a></li>
                        <li><a href="#faq">FAQ</a></li>
                    </ul>
                    <div class="mobile-menu-actions">
                        <a href="/trial" class="btn btn-outline">Przetestuj za darmo</a>
                        <a href="https://app.doginvoice.com" class="btn btn-primary" target="_blank" rel="noopener">Zaloguj się</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    
    <!-- Main Content -->
    <main class="site-main">
