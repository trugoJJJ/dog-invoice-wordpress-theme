#!/bin/bash

# 🚀 DogInvoice WordPress Theme - Automatic Installation Script
# This script will install WordPress and the DogInvoice theme

set -e

echo "🚀 Starting DogInvoice WordPress Theme Installation..."

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Function to print colored output
print_status() {
    echo -e "${BLUE}[INFO]${NC} $1"
}

print_success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

print_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# Check if running on macOS
if [[ "$OSTYPE" == "darwin"* ]]; then
    print_status "Detected macOS system"
    
    # Check if Homebrew is installed
    if ! command -v brew &> /dev/null; then
        print_error "Homebrew is not installed. Please install it first:"
        echo "  /bin/bash -c \"\$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)\""
        exit 1
    fi
    
    # Check if XAMPP is installed
    if [ ! -d "/Applications/XAMPP" ]; then
        print_warning "XAMPP is not installed. Installing..."
        brew install --cask xampp
    fi
    
    # Start XAMPP
    print_status "Starting XAMPP..."
    sudo /Applications/XAMPP/xamppfiles/xampp start
    
    # Set working directory
    WORK_DIR="/Applications/XAMPP/htdocs"
    SITE_DIR="$WORK_DIR/doginvoice-wp"
    
elif [[ "$OSTYPE" == "linux-gnu"* ]]; then
    print_status "Detected Linux system"
    
    # Check if Apache is installed
    if ! command -v apache2 &> /dev/null && ! command -v httpd &> /dev/null; then
        print_error "Apache is not installed. Please install it first:"
        echo "  Ubuntu/Debian: sudo apt install apache2 mysql-server php php-mysql"
        echo "  CentOS/RHEL: sudo yum install httpd mysql-server php php-mysql"
        exit 1
    fi
    
    # Set working directory
    WORK_DIR="/var/www/html"
    SITE_DIR="$WORK_DIR/doginvoice-wp"
    
else
    print_error "Unsupported operating system: $OSTYPE"
    exit 1
fi

# Create site directory
print_status "Creating site directory: $SITE_DIR"
mkdir -p "$SITE_DIR"
cd "$SITE_DIR"

# Download WordPress
if [ ! -f "wp-config.php" ]; then
    print_status "Downloading WordPress..."
    wget -q https://wordpress.org/latest.tar.gz
    tar -xzf latest.tar.gz --strip-components=1
    rm latest.tar.gz
    print_success "WordPress downloaded and extracted"
else
    print_warning "WordPress already exists in $SITE_DIR"
fi

# Set permissions
print_status "Setting permissions..."
if [[ "$OSTYPE" == "darwin"* ]]; then
    chmod -R 755 "$SITE_DIR"
else
    sudo chown -R www-data:www-data "$SITE_DIR"
    sudo chmod -R 755 "$SITE_DIR"
fi

# Create database
print_status "Creating database..."
if [[ "$OSTYPE" == "darwin"* ]]; then
    # XAMPP MySQL
    /Applications/XAMPP/xamppfiles/bin/mysql -u root -e "CREATE DATABASE IF NOT EXISTS doginvoice_wp;"
    /Applications/XAMPP/xamppfiles/bin/mysql -u root -e "CREATE USER IF NOT EXISTS 'doginvoice_user'@'localhost' IDENTIFIED BY 'doginvoice_pass';"
    /Applications/XAMPP/xamppfiles/bin/mysql -u root -e "GRANT ALL PRIVILEGES ON doginvoice_wp.* TO 'doginvoice_user'@'localhost';"
    /Applications/XAMPP/xamppfiles/bin/mysql -u root -e "FLUSH PRIVILEGES;"
else
    # System MySQL
    sudo mysql -e "CREATE DATABASE IF NOT EXISTS doginvoice_wp;"
    sudo mysql -e "CREATE USER IF NOT EXISTS 'doginvoice_user'@'localhost' IDENTIFIED BY 'doginvoice_pass';"
    sudo mysql -e "GRANT ALL PRIVILEGES ON doginvoice_wp.* TO 'doginvoice_user'@'localhost';"
    sudo mysql -e "FLUSH PRIVILEGES;"
fi

print_success "Database created: doginvoice_wp"

# Create wp-config.php
print_status "Creating wp-config.php..."
cat > wp-config.php << 'EOF'
<?php
/**
 * The base configuration for WordPress
 */

// ** Database settings ** //
define( 'DB_NAME', 'doginvoice_wp' );
define( 'DB_USER', 'doginvoice_user' );
define( 'DB_PASSWORD', 'doginvoice_pass' );
define( 'DB_HOST', 'localhost' );
define( 'DB_CHARSET', 'utf8mb4' );
define( 'DB_COLLATE', '' );

// ** Authentication Unique Keys and Salts ** //
define( 'AUTH_KEY',         'put your unique phrase here' );
define( 'SECURE_AUTH_KEY',  'put your unique phrase here' );
define( 'LOGGED_IN_KEY',    'put your unique phrase here' );
define( 'NONCE_KEY',        'put your unique phrase here' );
define( 'AUTH_SALT',        'put your unique phrase here' );
define( 'SECURE_AUTH_SALT', 'put your unique phrase here' );
define( 'LOGGED_IN_SALT',   'put your unique phrase here' );
define( 'NONCE_SALT',       'put your unique phrase here' );

// ** WordPress Database Table prefix ** //
$table_prefix = 'wp_';

// ** For developers: WordPress debugging mode ** //
define( 'WP_DEBUG', false );

// ** Absolute path to the WordPress directory ** //
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}

// ** Sets up WordPress vars and included files ** //
require_once ABSPATH . 'wp-settings.php';
EOF

# Install the DogInvoice theme
print_status "Installing DogInvoice theme..."
THEME_DIR="$SITE_DIR/wp-content/themes/doginvoice"
mkdir -p "$THEME_DIR"

# Copy theme files
cp -r "$(dirname "$0")"/* "$THEME_DIR/"

print_success "DogInvoice theme installed"

# Create .htaccess for pretty permalinks
print_status "Creating .htaccess..."
cat > .htaccess << 'EOF'
# BEGIN WordPress
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
RewriteBase /
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /index.php [L]
</IfModule>
# END WordPress
EOF

# Set final permissions
print_status "Setting final permissions..."
if [[ "$OSTYPE" == "darwin"* ]]; then
    chmod -R 755 "$SITE_DIR"
    chmod 644 .htaccess
else
    sudo chown -R www-data:www-data "$SITE_DIR"
    sudo chmod -R 755 "$SITE_DIR"
    sudo chmod 644 .htaccess
fi

print_success "WordPress installation completed!"

# Display information
echo ""
echo "🎉 Installation Summary:"
echo "========================"
echo "Site URL: http://localhost/doginvoice-wp"
echo "Admin URL: http://localhost/doginvoice-wp/wp-admin"
echo "Database: doginvoice_wp"
echo "Username: doginvoice_user"
echo "Password: doginvoice_pass"
echo ""
echo "📋 Next Steps:"
echo "1. Open http://localhost/doginvoice-wp in your browser"
echo "2. Complete the WordPress setup wizard"
echo "3. Activate the DogInvoice theme"
echo "4. Install ACF plugin"
echo "5. Run the data import script"
echo ""
echo "🔧 Theme Location: $THEME_DIR"
echo "📖 Documentation: $THEME_DIR/README.md"
echo "📖 Installation Guide: $THEME_DIR/install-guide.md"
echo ""

# Check if we can open the browser
if command -v open &> /dev/null; then
    read -p "Would you like to open the site in your browser? (y/n): " -n 1 -r
    echo
    if [[ $REPLY =~ ^[Yy]$ ]]; then
        open "http://localhost/doginvoice-wp"
    fi
fi

print_success "Installation completed successfully! 🚀"
