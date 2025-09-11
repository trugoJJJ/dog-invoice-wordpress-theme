# 🚀 Instalacja WordPress dla DogInvoice Theme

## Opcja 1: Lokalna instalacja (XAMPP/MAMP)

### 1. Pobierz i zainstaluj XAMPP
```bash
# macOS
brew install --cask xampp

# Lub pobierz z: https://www.apachefriends.org/
```

### 2. Uruchom XAMPP
```bash
# Uruchom Apache i MySQL
sudo /Applications/XAMPP/xamppfiles/xampp start
```

### 3. Pobierz WordPress
```bash
cd /Applications/XAMPP/htdocs
wget https://wordpress.org/latest.tar.gz
tar -xzf latest.tar.gz
mv wordpress doginvoice-wp
```

### 4. Skonfiguruj bazę danych
1. Otwórz http://localhost/phpmyadmin
2. Stwórz bazę danych: `doginvoice_wp`
3. Stwórz użytkownika: `doginvoice_user`
4. Hasło: `doginvoice_pass`

### 5. Skonfiguruj WordPress
1. Otwórz http://localhost/doginvoice-wp
2. Wypełnij dane bazy danych
3. Ustaw admina: admin / admin123

### 6. Zainstaluj motyw
```bash
# Skopiuj motyw do themes
cp -r dog-invoice-wordpress-theme /Applications/XAMPP/htdocs/doginvoice-wp/wp-content/themes/doginvoice
```

## Opcja 2: Docker (zalecane)

### 1. Stwórz docker-compose.yml
```yaml
version: '3.8'

services:
  wordpress:
    image: wordpress:latest
    ports:
      - "8080:80"
    environment:
      WORDPRESS_DB_HOST: db:3306
      WORDPRESS_DB_USER: wordpress
      WORDPRESS_DB_PASSWORD: wordpress
      WORDPRESS_DB_NAME: wordpress
    volumes:
      - ./wordpress:/var/www/html
      - ./dog-invoice-wordpress-theme:/var/www/html/wp-content/themes/doginvoice
    depends_on:
      - db

  db:
    image: mysql:8.0
    environment:
      MYSQL_DATABASE: wordpress
      MYSQL_USER: wordpress
      MYSQL_PASSWORD: wordpress
      MYSQL_ROOT_PASSWORD: rootpassword
    volumes:
      - db_data:/var/lib/mysql

volumes:
  db_data:
```

### 2. Uruchom Docker
```bash
docker-compose up -d
```

### 3. Otwórz WordPress
http://localhost:8080

## Opcja 3: Hosting (zalecane dla produkcji)

### 1. Wybierz hosting
- **Darmowy**: InfinityFree, 000webhost
- **Płatny**: SiteGround, WP Engine, Kinsta

### 2. Instalacja przez panel hostingu
1. Zaloguj się do panelu hostingu
2. Znajdź "WordPress Installer" (Softaculous, Installatron)
3. Kliknij "Install Now"
4. Wypełnij dane:
   - Domain: twoja-domena.com
   - Admin Username: admin
   - Admin Password: silne-hasło
   - Admin Email: twoj@email.com

### 3. Wgraj motyw
```bash
# Przez FTP/SFTP
scp -r dog-invoice-wordpress-theme user@serwer:/path/to/wp-content/themes/doginvoice
```

## Opcja 4: VPS/Serwer dedykowany

### 1. Skonfiguruj serwer
```bash
# Ubuntu/Debian
sudo apt update
sudo apt install apache2 mysql-server php php-mysql php-curl php-gd php-mbstring php-xml php-zip

# CentOS/RHEL
sudo yum update
sudo yum install httpd mysql-server php php-mysql php-curl php-gd php-mbstring php-xml php-zip
```

### 2. Pobierz WordPress
```bash
cd /var/www/html
wget https://wordpress.org/latest.tar.gz
tar -xzf latest.tar.gz
mv wordpress/* .
rm -rf wordpress latest.tar.gz
```

### 3. Skonfiguruj bazę danych
```bash
sudo mysql_secure_installation
mysql -u root -p
CREATE DATABASE wordpress;
CREATE USER 'wordpress'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON wordpress.* TO 'wordpress'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

### 4. Skonfiguruj WordPress
1. Otwórz http://twoja-domena.com
2. Wypełnij dane bazy danych
3. Ustaw admina

### 5. Wgraj motyw
```bash
scp -r dog-invoice-wordpress-theme user@serwer:/var/www/html/wp-content/themes/doginvoice
```

## Następne kroki po instalacji

### 1. Aktywuj motyw
1. Zaloguj się do WordPress: /wp-admin
2. Przejdź do **Wygląd > Motywy**
3. Aktywuj **DogInvoice**

### 2. Zainstaluj ACF
1. **Wtyczki > Dodaj nową**
2. Wyszukaj "Advanced Custom Fields"
3. Zainstaluj i aktywuj

### 3. Zaimportuj dane przykładowe
```bash
# Uruchom skrypt importu
https://twoja-domena.com/wp-content/themes/doginvoice/data-import.php?run_import=true
```

### 4. Skonfiguruj ustawienia
1. **DogInvoice Settings**
2. Wgraj logo
3. Dodaj dane kontaktowe
4. Skonfiguruj linki społecznościowe

## Troubleshooting

### Problem: Błąd 500
```bash
# Sprawdź logi
tail -f /var/log/apache2/error.log
# Lub
tail -f /var/log/nginx/error.log
```

### Problem: Błąd bazy danych
```bash
# Sprawdź połączenie
mysql -u wordpress -p wordpress
```

### Problem: Brak uprawnień
```bash
# Ustaw uprawnienia
sudo chown -R www-data:www-data /var/www/html
sudo chmod -R 755 /var/www/html
```

### Problem: ACF nie działa
1. Sprawdź czy wtyczka jest aktywna
2. Sprawdź czy plik `acf-fields.php` jest dołączony
3. Wyczyść cache

## Bezpieczeństwo

### 1. Zmień domyślne ustawienia
```bash
# Zmień prefix tabel
wp config set DB_PREFIX "wp_doginvoice_"
```

### 2. Ustaw silne hasła
```bash
# Zmień hasło admina
wp user update admin --user_pass="nowe-silne-haslo"
```

### 3. Zainstaluj wtyczki bezpieczeństwa
- Wordfence Security
- iThemes Security
- Sucuri Security

### 4. Skonfiguruj SSL
```bash
# Let's Encrypt
sudo certbot --apache -d twoja-domena.com
```

## Performance

### 1. Cache
- WP Rocket
- W3 Total Cache
- WP Super Cache

### 2. CDN
- Cloudflare
- MaxCDN
- Amazon CloudFront

### 3. Optymalizacja obrazów
- Smush
- ShortPixel
- WebP Express

## Backup

### 1. Automatyczny backup
- UpdraftPlus
- BackWPup
- Duplicator

### 2. Ręczny backup
```bash
# Baza danych
mysqldump -u wordpress -p wordpress > backup.sql

# Pliki
tar -czf wordpress-backup.tar.gz /var/www/html
```
