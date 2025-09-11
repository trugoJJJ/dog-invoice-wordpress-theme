# DogInvoice WordPress Theme

Kompleksowy motyw WordPress dla DogInvoice - systemu zarządzania fakturami z wykorzystaniem AI.

## 🚀 Funkcjonalności

- **ACF Integration** - Pełna integracja z Advanced Custom Fields
- **Custom Post Types** - Własne typy postów dla wszystkich sekcji
- **REST API** - Endpointy API dla dynamicznych danych
- **Responsive Design** - Pełna responsywność na wszystkich urządzeniach
- **Dark Mode** - Obsługa trybu ciemnego
- **Performance** - Zoptymalizowany pod kątem wydajności
- **SEO Ready** - Przygotowany pod kątem SEO

## 📦 Instalacja

### 1. Wymagania
- WordPress 5.0+
- PHP 7.4+
- ACF (Advanced Custom Fields) - darmowa wersja wystarczy

### 2. Instalacja motywu
```bash
# Skopiuj folder motywu do katalogu themes
cp -r wordpress-theme /wp-content/themes/doginvoice
```

### 3. Aktywacja
1. Przejdź do **Wygląd > Motywy** w panelu WordPress
2. Aktywuj motyw **DogInvoice**

### 4. Instalacja ACF
1. Przejdź do **Wtyczki > Dodaj nową**
2. Wyszukaj "Advanced Custom Fields"
3. Zainstaluj i aktywuj wtyczkę

## 🎯 Konfiguracja

### 1. Import danych przykładowych
Po aktywacji motywu, wszystkie pola ACF zostaną automatycznie utworzone.

### 2. Dodawanie treści

#### Hero Section
1. Przejdź do **Hero Section > Dodaj nowy**
2. Wypełnij pola:
   - Tytuł główny
   - Podtytuł
   - URL Video
   - Przyciski CTA

#### Kroki procesu
1. Przejdź do **Kroki procesu > Dodaj nowy**
2. Dla każdego kroku ustaw:
   - Numer kroku
   - Ikona
   - Pozycję X i Y
   - URL video

#### Funkcjonalności
1. Przejdź do **Funkcjonalności > Dodaj nowy**
2. Wypełnij:
   - Tytuł i opis
   - Ikona
   - Podświetlenie
   - URL video

#### Integracje
1. Przejdź do **Integracje > Dodaj nowy**
2. Dodaj:
   - Logo integracji
   - URL
   - Status "Wkrótce"

#### Plany cenowe
1. Przejdź do **Plany cenowe > Dodaj nowy**
2. Ustaw:
   - Cenę i okres
   - Listę funkcjonalności
   - Przycisk CTA
   - Status "Popularny"

#### FAQ
1. Przejdź do **FAQ > Dodaj nowy**
2. Dodaj pytania i odpowiedzi

### 3. Ustawienia globalne
1. Przejdź do **DogInvoice Settings**
2. Skonfiguruj:
   - Logo strony
   - Dane kontaktowe
   - Linki społecznościowe

## 🔧 Custom Post Types

### DogInvoice Hero
- `doginvoice_hero` - Sekcja hero na stronie głównej

### Process Steps
- `process_steps` - Kroki procesu z pozycjonowaniem

### Features
- `features` - Funkcjonalności produktu

### Integrations
- `integrations` - Integracje z zewnętrznymi systemami

### Benefits
- `benefits` - Korzyści z używania produktu

### FAQ
- `faq` - Najczęściej zadawane pytania

### Pricing Plans
- `pricing_plans` - Plany cenowe

## 🌐 REST API Endpoints

### Hero Data
```
GET /wp-json/doginvoice/v1/hero
```

### Process Steps
```
GET /wp-json/doginvoice/v1/steps
```

### Features
```
GET /wp-json/doginvoice/v1/features
```

### Integrations
```
GET /wp-json/doginvoice/v1/integrations
```

### Benefits
```
GET /wp-json/doginvoice/v1/benefits
```

### FAQ
```
GET /wp-json/doginvoice/v1/faq
```

### Pricing Plans
```
GET /wp-json/doginvoice/v1/pricing
```

## 🎨 Customizacja

### Kolory
Motyw używa CSS custom properties. Możesz je zmienić w `assets/css/style.css`:

```css
:root {
    --primary: 27 87% 53%;        /* Główny kolor */
    --secondary: 210 40% 98%;     /* Kolor drugorzędny */
    --background: 0 0% 100%;      /* Tło */
    --foreground: 222.2 84% 4.9%; /* Tekst */
}
```

### Ikony
Ikony są implementowane jako emoji. Możesz je zmienić w `assets/css/style.css`:

```css
.icon-upload::before { content: '📤'; }
.icon-check-circle::before { content: '✓'; }
```

### Animacje
Animacje są kontrolowane przez JavaScript w `assets/js/main.js`.

## 📱 Responsywność

Motyw jest w pełni responsywny z breakpointami:
- **Desktop**: 1200px+
- **Tablet**: 768px - 1199px
- **Mobile**: 320px - 767px

## 🔍 SEO

### Meta Tags
- Open Graph
- Twitter Cards
- Canonical URLs
- Structured Data

### Performance
- Lazy loading obrazów
- Minifikacja CSS/JS
- Optymalizacja fontów
- Caching

## 🛠️ Rozwój

### Struktura plików
```
wordpress-theme/
├── functions.php          # Główne funkcje motywu
├── acf-fields.php         # Pola ACF
├── index.php             # Główny szablon
├── header.php            # Nagłówek
├── footer.php            # Stopka
├── style.css             # Informacje o motywie
├── assets/
│   ├── css/
│   │   └── style.css     # Główne style
│   ├── js/
│   │   └── main.js       # JavaScript
│   └── images/           # Obrazy
└── README.md             # Dokumentacja
```

### Hooks i filtry
```php
// Dodaj własne style
add_action('wp_enqueue_scripts', 'my_custom_styles');

// Modyfikuj dane API
add_filter('doginvoice_hero_data', 'modify_hero_data');
```

## 🐛 Rozwiązywanie problemów

### ACF nie działa
1. Sprawdź czy wtyczka jest aktywna
2. Sprawdź czy plik `acf-fields.php` jest dołączony w `functions.php`

### Style nie ładują się
1. Sprawdź ścieżki w `functions.php`
2. Wyczyść cache WordPress

### API nie zwraca danych
1. Sprawdź czy posty są opublikowane
2. Sprawdź uprawnienia REST API

## 📞 Wsparcie

- **Email**: support@doginvoice.com
- **Dokumentacja**: https://docs.doginvoice.com
- **GitHub**: https://github.com/doginvoice/wordpress-theme

## 📄 Licencja

GPL v2 or later - https://www.gnu.org/licenses/gpl-2.0.html

## 🔄 Changelog

### v1.0.0
- Pierwsza wersja motywu
- Pełna integracja z ACF
- Wszystkie sekcje z oryginalnego designu
- REST API endpoints
- Responsywny design
- Dark mode support
