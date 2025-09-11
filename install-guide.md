# 🚀 Przewodnik instalacji DogInvoice WordPress Theme

## Krok po kroku - od zera do działającej strony

### 1. 📋 Wymagania systemowe

**Serwer:**
- PHP 7.4 lub nowszy
- MySQL 5.7 lub nowszy
- Apache/Nginx z mod_rewrite
- SSL certyfikat (zalecane)

**WordPress:**
- WordPress 5.0 lub nowszy
- Aktywne permalinki

### 2. 🎯 Instalacja WordPress

#### Opcja A: Instalacja przez hosting
1. Zaloguj się do panelu hostingu
2. Znajdź opcję "Instalator WordPress" (Softaculous, Installatron)
3. Kliknij "Install Now"
4. Wypełnij dane:
   - **Domain**: twoja-domena.com
   - **Admin Username**: admin
   - **Admin Password**: silne-hasło
   - **Admin Email**: twoj@email.com

#### Opcja B: Instalacja ręczna
1. Pobierz WordPress z wordpress.org
2. Wgraj pliki na serwer
3. Utwórz bazę danych MySQL
4. Uruchom instalator: `twoja-domena.com/wp-admin/install.php`

### 3. 📦 Instalacja motywu DogInvoice

#### Krok 1: Wgranie plików
```bash
# Przez FTP/SFTP
scp -r wordpress-theme/ user@serwer:/path/to/wp-content/themes/doginvoice

# Lub przez panel hostingu
# Wgraj folder wordpress-theme do /wp-content/themes/doginvoice
```

#### Krok 2: Aktywacja motywu
1. Zaloguj się do WordPress: `twoja-domena.com/wp-admin`
2. Przejdź do **Wygląd > Motywy**
3. Znajdź **DogInvoice** i kliknij **Aktywuj**

### 4. 🔌 Instalacja wtyczek

#### ACF (Advanced Custom Fields)
1. Przejdź do **Wtyczki > Dodaj nową**
2. Wyszukaj "Advanced Custom Fields"
3. Kliknij **Zainstaluj** i **Aktywuj**

#### Opcjonalne wtyczki (zalecane):
- **Yoast SEO** - optymalizacja SEO
- **WP Rocket** - cache i wydajność
- **UpdraftPlus** - backup
- **Wordfence** - bezpieczeństwo

### 5. ⚙️ Konfiguracja podstawowa

#### Ustawienia WordPress
1. **Ustawienia > Ogólne**:
   - Tytuł witryny: DogInvoice
   - Tagline: Automatyczne zarządzanie fakturami
   - Adres WordPress: `https://twoja-domena.com`
   - Adres witryny: `https://twoja-domena.com`

2. **Ustawienia > Stałe linki**:
   - Wybierz "Nazwa wpisu"
   - Kliknij **Zapisz zmiany**

#### Ustawienia motywu
1. Przejdź do **DogInvoice Settings**
2. Wypełnij podstawowe dane:
   - Logo strony
   - Email kontaktowy
   - Telefon kontaktowy

### 6. 📝 Dodawanie treści

#### Hero Section
1. **Hero Section > Dodaj nowy**
2. Wypełnij pola:
   ```
   Tytuł główny: Robisz zdjęcie faktury, a reszta dzieje się automatycznie
   Podtytuł: DogInvoice automatycznie organizuje Twoje dokumenty, eliminuje chaos administracyjny i pozwala Ci skupić się na tym, co naprawdę ważne.
   URL Video: /videos/doginvoice_hero.mp4
   Tekst przycisku głównego: Wybierz swój plan
   URL przycisku głównego: #pricing
   Tekst przycisku drugiego: Przetestuj za darmo
   URL przycisku drugiego: /trial
   ```

#### Kroki procesu (5 kroków)
1. **Kroki procesu > Dodaj nowy**

**Krok 1:**
```
Tytuł: Wielokanałowy odbiór
Numer kroku: 01
Ikona: upload
Pozycja X: 20
Pozycja Y: 30
Opis: Wysyłaj faktury przez email, SMS, WhatsApp lub bezpośrednio z aplikacji mobilnej.
```

**Krok 2:**
```
Tytuł: Weryfikacja dokumentów
Numer kroku: 02
Ikona: check-circle
Pozycja X: 40
Pozycja Y: 20
Opis: System automatycznie weryfikuje poprawność danych i wykrywa błędy.
```

**Krok 3:**
```
Tytuł: Analiza AI
Numer kroku: 03
Ikona: brain
Pozycja X: 60
Pozycja Y: 30
Opis: Zaawansowane algorytmy AI analizują i kategoryzują dokumenty.
```

**Krok 4:**
```
Tytuł: Archiwizacja
Numer kroku: 04
Ikona: folder-open
Pozycja X: 80
Pozycja Y: 20
Opis: Dokumenty są automatycznie archiwizowane i indeksowane.
```

**Krok 5:**
```
Tytuł: Dashboard
Numer kroku: 05
Ikona: bar-chart-3
Pozycja X: 50
Pozycja Y: 50
Opis: Kompletny przegląd finansów w czasie rzeczywistym.
```

#### Funkcjonalności
1. **Funkcjonalności > Dodaj nowy**

**Funkcjonalność 1:**
```
Tytuł: Automatyzacja procesów
Ikona: zap
Podświetlenie: Auto-categorize
Opis: Automatyczne kategoryzowanie i klasyfikacja dokumentów bez interwencji użytkownika.
```

**Funkcjonalność 2:**
```
Tytuł: Analiza finansowa
Ikona: settings
Podświetlenie: Real-time
Opis: Na bieżąco monitoruj koszty i przychody dzięki intuicyjnym zestawieniom i wykresom.
```

**Funkcjonalność 3:**
```
Tytuł: Wzrost wydajności
Ikona: trending-up
Podświetlenie: +300%
Opis: Zwiększ wydajność swojego zespołu o 300% dzięki automatyzacji rutynowych zadań.
```

#### Integracje
1. **Integracje > Dodaj nowy**

Dodaj integracje z logo:
- KSeF (logo: ksef_logo.svg)
- Fakturownia (logo: fakturownia_logo.svg)
- Google Drive (logo: google_drive_logo.svg)
- Gmail (logo: logo_gmail.svg)
- SMTP/IMAP (logo: smtp_imap_icon.svg)
- Comarch Optima (logo: optima_logo.svg)

#### Plany cenowe
1. **Plany cenowe > Dodaj nowy**

**Plan Basic:**
```
Nazwa: Basic
Cena: 99
Okres: /miesiąc
Funkcjonalności:
- 100 faktur/miesiąc
- Podstawowe raporty
- Email support
- Integracja z 3 systemami
Przycisk: Rozpocznij
```

**Plan Pro:**
```
Nazwa: Pro
Cena: 199
Okres: /miesiąc
Popularny: Tak
Funkcjonalności:
- 500 faktur/miesiąc
- Zaawansowane raporty
- Priority support
- Wszystkie integracje
- API access
Przycisk: Rozpocznij
```

**Plan Enterprise:**
```
Nazwa: Enterprise
Cena: Kontakt
Okres: 
Funkcjonalności:
- Nielimitowane faktury
- Custom integrations
- Dedicated support
- SLA 99.9%
- On-premise deployment
Przycisk: Skontaktuj się
```

#### FAQ
1. **FAQ > Dodaj nowy**

Dodaj najczęstsze pytania:
- Jak działa automatyczne rozpoznawanie faktur?
- Czy moje dane są bezpieczne?
- Jakie integracje są dostępne?
- Czy mogę anulować subskrypcję?
- Jak działa system backup?

### 7. 🎨 Personalizacja

#### Logo i kolory
1. **DogInvoice Settings > Ustawienia globalne**
2. Wgraj logo strony
3. Dodaj dane kontaktowe
4. Skonfiguruj linki społecznościowe

#### Kolory (opcjonalne)
Edytuj `assets/css/style.css`:
```css
:root {
    --primary: 27 87% 53%;        /* Zmień na swój kolor */
    --secondary: 210 40% 98%;     /* Kolor drugorzędny */
}
```

### 8. 🚀 Optymalizacja

#### Cache
1. Zainstaluj wtyczkę cache (WP Rocket, W3 Total Cache)
2. Skonfiguruj cache dla:
   - Strony
   - Posty
   - CSS/JS
   - Obrazy

#### SEO
1. **Yoast SEO > Ogólne**
2. Skonfiguruj:
   - Meta description
   - Open Graph
   - Schema markup

#### Bezpieczeństwo
1. **Wordfence > Firewall**
2. Włącz:
   - Firewall
   - Skanowanie malware
   - Brute force protection

### 9. 📊 Monitoring

#### Google Analytics
1. Utwórz konto Google Analytics
2. Dodaj kod śledzenia do `header.php`

#### Google Search Console
1. Zweryfikuj własność domeny
2. Prześlij sitemap: `twoja-domena.com/sitemap.xml`

### 10. ✅ Testowanie

#### Sprawdź:
- [ ] Strona główna ładuje się poprawnie
- [ ] Wszystkie sekcje wyświetlają się
- [ ] Linki działają
- [ ] Formularze działają
- [ ] Responsywność na mobile
- [ ] Szybkość ładowania < 3s
- [ ] SEO score > 90

#### Narzędzia testowe:
- **PageSpeed Insights**: https://pagespeed.web.dev/
- **GTmetrix**: https://gtmetrix.com/
- **Mobile-Friendly Test**: https://search.google.com/test/mobile-friendly

### 11. 🎉 Gotowe!

Twoja strona DogInvoice jest gotowa! 

**Następne kroki:**
1. Skonfiguruj domenę
2. Ustaw SSL
3. Skonfiguruj backup
4. Dodaj Google Analytics
5. Przetestuj wszystkie funkcje

**Wsparcie:**
- Email: support@doginvoice.com
- Dokumentacja: https://docs.doginvoice.com
- GitHub: https://github.com/doginvoice/wordpress-theme

---

## 🔧 Rozwiązywanie problemów

### Problem: Strona nie ładuje się
**Rozwiązanie:**
1. Sprawdź uprawnienia plików (755 dla folderów, 644 dla plików)
2. Sprawdź .htaccess
3. Wyłącz wtyczki po kolei

### Problem: ACF nie działa
**Rozwiązanie:**
1. Sprawdź czy wtyczka jest aktywna
2. Sprawdź czy plik `acf-fields.php` jest dołączony
3. Wyczyść cache

### Problem: Style nie ładują się
**Rozwiązanie:**
1. Sprawdź ścieżki w `functions.php`
2. Sprawdź uprawnienia do folderu `assets`
3. Wyczyść cache przeglądarki

### Problem: API nie zwraca danych
**Rozwiązanie:**
1. Sprawdź czy posty są opublikowane
2. Sprawdź uprawnienia REST API
3. Sprawdź logi błędów WordPress
