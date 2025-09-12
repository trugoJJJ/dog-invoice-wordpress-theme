<?php
/**
 * The main template file
 * 
 * @package DogInvoice
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <div class="hero-section">
            <h1 class="hero-title">Robisz zdjęcie faktury, a reszta dzieje się automatycznie</h1>
            <p class="hero-subtitle">DogInvoice automatycznie organizuje Twoje dokumenty, eliminuje chaos administracyjny i pozwala Ci skupić się na tym, co naprawdę ważne.</p>
            <div class="hero-buttons">
                <a href="#pricing" class="btn btn-primary">Wybierz swój plan</a>
                <a href="/trial" class="btn btn-secondary">Przetestuj za darmo</a>
            </div>
        </div>

        <div class="animated-numbers">
            <div class="number-block">
                <div class="number-value text-primary">50,000+</div>
                <h3 class="number-title">Przetworzonych faktur</h3>
                <p class="number-description">przez naszych klientów</p>
            </div>
            <div class="number-block">
                <div class="number-value text-orange-500">15h</div>
                <h3 class="number-title">Oszczędności tygodniowo</h3>
                <p class="number-description">średnio na każdego użytkownika</p>
            </div>
            <div class="number-block">
                <div class="number-value text-primary">99%</div>
                <h3 class="number-title">Dokładność AI</h3>
                <p class="number-description">w rozpoznawaniu danych z faktur</p>
            </div>
        </div>

        <div class="features-section">
            <h2 class="features-title">Zmień sposób zarządzania finansami</h2>
            <p class="features-subtitle">Poznaj trzy fundamenty, które poprawią wydajność pracy księgowej.</p>
            
            <div class="feature-item">
                <div class="feature-content">
                    <h3 class="feature-title">Automatyzacja i integracja z AI</h3>
                    <p class="feature-description">Faktury przychodzące mailem lub przez dedykowany portal są automatycznie przetwarzane przez algorytm AI, który między innymi wykrywa kategorię wydatku.</p>
                </div>
                <div class="feature-video">
                    <div class="feature-video-container">
                        <div class="feature-video-inner">
                            <div class="feature-video-aspect">
                                <video class="feature-video-element" autoplay muted loop playsinline>
                                    <source src="/videos/aiautomation.mp4" type="video/mp4">
                                    Twoja przeglądarka nie wspiera odtwarzania wideo.
                                </video>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="feature-item">
                <div class="feature-content">
                    <h3 class="feature-title">Obsługa trudnych przypadków</h3>
                    <p class="feature-description">Jeśli zdjęcie faktury jest nieczytelne lub niewyraźne, automatycznie korzystamy z autorskiej technologii AI OCR, aby zapewnić poprawne odczytanie wszystkich informacji.</p>
                </div>
                <div class="feature-video">
                    <div class="feature-video-container">
                        <div class="feature-video-inner">
                            <div class="feature-video-aspect">
                                <video class="feature-video-element" autoplay muted loop playsinline>
                                    <source src="/videos/realtime.mp4" type="video/mp4">
                                    Twoja przeglądarka nie wspiera odtwarzania wideo.
                                </video>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="feature-item">
                <div class="feature-content">
                    <h3 class="feature-title">Analiza finansowa</h3>
                    <p class="feature-description">Na bieżąco monitoruj koszty i przychody dzięki intuicyjnym zestawieniom i wykresom. Komplet dokumentów można później łatwo wysłać do księgowej.</p>
                </div>
                <div class="feature-video">
                    <div class="feature-video-container">
                        <div class="feature-video-inner">
                            <div class="feature-video-aspect">
                                <video class="feature-video-element" autoplay muted loop playsinline>
                                    <source src="/videos/integration.mp4" type="video/mp4">
                                    Twoja przeglądarka nie wspiera odtwarzania wideo.
                                </video>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pricing-section" id="pricing">
            <h2 class="pricing-title">Prosty cennik</h2>
            <p class="pricing-subtitle">Wybierz plan idealny dla Twojej firmy.</p>
            
            <div class="pricing-grid">
                <div class="pricing-card">
                    <div class="pricing-card-content">
                        <h3 class="pricing-card-title">Starter</h3>
                        <p class="pricing-card-description">Na dobry początek.</p>
                        <div class="pricing-card-price">
                            <div class="pricing-price-value">0 zł</div>
                            <span class="pricing-price-suffix">/ miesięcznie</span>
                        </div>
                        <p class="pricing-card-invoices">10 faktur miesięcznie.</p>
                        <a href="/trial?plan=starter&billing=monthly" class="pricing-card-button">Rozpocznij za darmo</a>
                    </div>
                </div>

                <div class="pricing-card pricing-card-popular">
                    <div class="pricing-card-content">
                        <h3 class="pricing-card-title">Professional</h3>
                        <p class="pricing-card-description">Dla rozwijających się firm.</p>
                        <div class="pricing-card-price">
                            <div class="pricing-price-value">149 zł</div>
                            <span class="pricing-price-suffix">/ miesięcznie</span>
                        </div>
                        <p class="pricing-card-invoices">150 faktur miesięcznie.</p>
                        <a href="/trial?plan=professional&billing=monthly" class="pricing-card-button pricing-card-button-popular">Wybierz plan</a>
                    </div>
                </div>

                <div class="pricing-card">
                    <div class="pricing-card-content">
                        <h3 class="pricing-card-title">Business</h3>
                        <p class="pricing-card-description">Dla dużych organizacji.</p>
                        <div class="pricing-card-price">
                            <div class="pricing-price-value">299 zł</div>
                            <span class="pricing-price-suffix">/ miesięcznie</span>
                        </div>
                        <p class="pricing-card-invoices">500 faktur miesięcznie.</p>
                        <a href="/trial?plan=business&billing=monthly" class="pricing-card-button">Wybierz plan</a>
                    </div>
                </div>

                <div class="pricing-card">
                    <div class="pricing-card-content">
                        <h3 class="pricing-card-title">Enterprise</h3>
                        <p class="pricing-card-description">Dla tych, którzy potrzebują więcej</p>
                        <div class="pricing-card-price">
                            <div class="pricing-price-value">Wycena indywidualna</div>
                        </div>
                        <p class="pricing-card-invoices">Niestandardowe rozwiązania.</p>
                        <a href="/trial?plan=enterprise&billing=monthly" class="pricing-card-button">Wybierz plan</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="cta-section">
            <h2 class="cta-title">Zacznij już dziś</h2>
            <p class="cta-subtitle">Dołącz do firm, które oszczędzają 15 godzin tygodniowo dzięki automatyzacji.</p>
            <div class="cta-buttons">
                <a href="#pricing" class="cta-button cta-button-primary">Wybierz swój plan</a>
                <a href="/trial" class="cta-button cta-button-secondary">Przetestuj za darmo</a>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
