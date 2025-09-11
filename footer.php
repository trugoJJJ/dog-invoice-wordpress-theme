    </main>
    
    <!-- Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-content">
                <!-- Footer Logo and Description -->
                <div class="footer-brand">
                    <div class="footer-logo">
                        <?php 
                        $site_logo = get_field('site_logo', 'option');
                        if ($site_logo): ?>
                            <img src="<?php echo esc_url($site_logo); ?>" alt="<?php bloginfo('name'); ?>" class="logo-image">
                        <?php else: ?>
                            <span class="logo-text"><?php bloginfo('name'); ?></span>
                        <?php endif; ?>
                    </div>
                    <p class="footer-description">
                        DogInvoice automatycznie organizuje Twoje dokumenty, eliminuje chaos administracyjny i pozwala Ci skupić się na tym, co naprawdę ważne.
                    </p>
                </div>
                
                <!-- Footer Links -->
                <div class="footer-links">
                    <div class="footer-column">
                        <h3>Produkt</h3>
                        <ul>
                            <li><a href="#features">Funkcjonalności</a></li>
                            <li><a href="#process">Jak to działa</a></li>
                            <li><a href="#integrations">Integracje</a></li>
                            <li><a href="#pricing">Cennik</a></li>
                        </ul>
                    </div>
                    
                    <div class="footer-column">
                        <h3>Firma</h3>
                        <ul>
                            <li><a href="/about">O nas</a></li>
                            <li><a href="/blog">Blog</a></li>
                            <li><a href="/careers">Kariera</a></li>
                            <li><a href="/contact">Kontakt</a></li>
                        </ul>
                    </div>
                    
                    <div class="footer-column">
                        <h3>Wsparcie</h3>
                        <ul>
                            <li><a href="/help">Centrum pomocy</a></li>
                            <li><a href="/docs">Dokumentacja</a></li>
                            <li><a href="/tutorials">Tutoriale</a></li>
                            <li><a href="/status">Status systemu</a></li>
                        </ul>
                    </div>
                    
                    <div class="footer-column">
                        <h3>Prawne</h3>
                        <ul>
                            <li><a href="/privacy">Polityka prywatności</a></li>
                            <li><a href="/terms">Regulamin</a></li>
                            <li><a href="/cookies">Polityka cookies</a></li>
                            <li><a href="/gdpr">RODO</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="footer-bottom-content">
                    <div class="footer-copyright">
                        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Wszystkie prawa zastrzeżone.</p>
                    </div>
                    
                    <!-- Social Links -->
                    <div class="footer-social">
                        <?php 
                        $social_links = get_field('social_links', 'option');
                        if ($social_links): ?>
                            <?php foreach ($social_links as $social): ?>
                                <a href="<?php echo esc_url($social['url']); ?>" 
                                   target="_blank" 
                                   rel="noopener" 
                                   aria-label="<?php echo esc_attr($social['name']); ?>"
                                   class="social-link">
                                    <i class="icon-<?php echo esc_attr($social['icon']); ?>"></i>
                                </a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Back to Top Button -->
    <button class="back-to-top" aria-label="Back to top">
        <i class="icon-chevron-up"></i>
    </button>
    
    <!-- Cookie Consent (if needed) -->
    <div id="cookie-consent" class="cookie-consent" style="display: none;">
        <div class="cookie-content">
            <p>Używamy plików cookies, aby zapewnić najlepsze doświadczenia na naszej stronie. <a href="/cookies">Dowiedz się więcej</a></p>
            <div class="cookie-actions">
                <button class="btn btn-outline" id="cookie-decline">Odrzuć</button>
                <button class="btn btn-primary" id="cookie-accept">Akceptuję</button>
            </div>
        </div>
    </div>
    
    <?php wp_footer(); ?>
    
    <!-- Additional Footer Scripts -->
    <script>
        // Back to top functionality
        const backToTopBtn = document.querySelector('.back-to-top');
        
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopBtn.style.display = 'block';
            } else {
                backToTopBtn.style.display = 'none';
            }
        });
        
        backToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
        
        // Mobile menu functionality
        const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
        const mobileMenu = document.querySelector('.mobile-menu');
        
        mobileMenuToggle.addEventListener('click', function() {
            mobileMenu.classList.toggle('active');
            this.classList.toggle('active');
        });
        
        // Close mobile menu when clicking on a link
        const mobileMenuLinks = document.querySelectorAll('.mobile-nav-list a');
        mobileMenuLinks.forEach(link => {
            link.addEventListener('click', function() {
                mobileMenu.classList.remove('active');
                mobileMenuToggle.classList.remove('active');
            });
        });
        
        // Cookie consent functionality
        const cookieConsent = document.getElementById('cookie-consent');
        const cookieAccept = document.getElementById('cookie-accept');
        const cookieDecline = document.getElementById('cookie-decline');
        
        // Check if user has already made a choice
        if (!localStorage.getItem('cookieConsent')) {
            cookieConsent.style.display = 'block';
        }
        
        cookieAccept.addEventListener('click', function() {
            localStorage.setItem('cookieConsent', 'accepted');
            cookieConsent.style.display = 'none';
        });
        
        cookieDecline.addEventListener('click', function() {
            localStorage.setItem('cookieConsent', 'declined');
            cookieConsent.style.display = 'none';
        });
        
        // Theme toggle functionality
        const themeToggle = document.querySelector('.theme-toggle');
        const themeIcon = document.querySelector('.theme-icon');
        
        themeToggle.addEventListener('click', function() {
            const body = document.body;
            const isDark = body.classList.contains('dark');
            
            if (isDark) {
                body.classList.remove('dark');
                themeIcon.textContent = '🌙';
                localStorage.setItem('theme', 'light');
            } else {
                body.classList.add('dark');
                themeIcon.textContent = '☀️';
                localStorage.setItem('theme', 'dark');
            }
        });
        
        // Load saved theme
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            document.body.classList.add('dark');
            themeIcon.textContent = '☀️';
        }
    </script>
    
    <!-- Additional CSS for Footer -->
    <style>
        .site-footer {
            background-color: hsl(var(--muted) / 0.3);
            border-top: 1px solid hsl(var(--border));
            padding: 4rem 0 2rem;
            margin-top: 6rem;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 4rem;
            margin-bottom: 3rem;
        }
        
        .footer-brand {
            max-width: 400px;
        }
        
        .footer-logo {
            margin-bottom: 1rem;
        }
        
        .footer-logo .logo-image {
            height: 40px;
            width: auto;
        }
        
        .footer-logo .logo-text {
            font-size: 1.5rem;
            font-weight: 700;
            color: hsl(var(--foreground));
        }
        
        .footer-description {
            color: hsl(var(--muted-foreground));
            line-height: 1.6;
        }
        
        .footer-links {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
        }
        
        .footer-column h3 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: hsl(var(--foreground));
        }
        
        .footer-column ul {
            list-style: none;
        }
        
        .footer-column li {
            margin-bottom: 0.5rem;
        }
        
        .footer-column a {
            color: hsl(var(--muted-foreground));
            text-decoration: none;
            transition: color 0.2s ease;
        }
        
        .footer-column a:hover {
            color: hsl(var(--primary));
        }
        
        .footer-bottom {
            border-top: 1px solid hsl(var(--border));
            padding-top: 2rem;
        }
        
        .footer-bottom-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .footer-copyright p {
            color: hsl(var(--muted-foreground));
            font-size: 0.875rem;
        }
        
        .footer-social {
            display: flex;
            gap: 1rem;
        }
        
        .social-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: hsl(var(--muted));
            color: hsl(var(--muted-foreground));
            text-decoration: none;
            transition: all 0.2s ease;
        }
        
        .social-link:hover {
            background-color: hsl(var(--primary));
            color: hsl(var(--primary-foreground));
            transform: translateY(-2px);
        }
        
        .back-to-top {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: hsl(var(--primary));
            color: hsl(var(--primary-foreground));
            border: none;
            cursor: pointer;
            display: none;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transition: all 0.2s ease;
            z-index: 100;
        }
        
        .back-to-top:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
        }
        
        .cookie-consent {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: hsl(var(--card));
            border-top: 1px solid hsl(var(--border));
            padding: 1rem;
            z-index: 1000;
        }
        
        .cookie-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 2rem;
        }
        
        .cookie-content p {
            color: hsl(var(--muted-foreground));
            margin: 0;
        }
        
        .cookie-content a {
            color: hsl(var(--primary));
            text-decoration: none;
        }
        
        .cookie-actions {
            display: flex;
            gap: 1rem;
        }
        
        .btn-outline {
            background-color: transparent;
            color: hsl(var(--foreground));
            border: 1px solid hsl(var(--border));
        }
        
        .btn-outline:hover {
            background-color: hsl(var(--accent));
        }
        
        @media (max-width: 768px) {
            .footer-content {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            
            .footer-links {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.5rem;
            }
            
            .footer-bottom-content {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
            
            .cookie-content {
                flex-direction: column;
                text-align: center;
            }
            
            .cookie-actions {
                justify-content: center;
            }
        }
        
        @media (max-width: 480px) {
            .footer-links {
                grid-template-columns: 1fr;
            }
            
            .back-to-top {
                bottom: 1rem;
                right: 1rem;
                width: 45px;
                height: 45px;
            }
        }
    </style>
</body>
</html>
