#!/bin/bash

# 🐳 DogInvoice WordPress Theme - Docker Installation Script

set -e

echo "🐳 Starting DogInvoice WordPress Theme Docker Installation..."

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

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

# Check if Docker is installed
if ! command -v docker &> /dev/null; then
    print_error "Docker is not installed. Please install it first:"
    echo "  macOS: https://docs.docker.com/desktop/mac/install/"
    echo "  Linux: https://docs.docker.com/engine/install/"
    echo "  Windows: https://docs.docker.com/desktop/windows/install/"
    exit 1
fi

# Check if Docker Compose is installed
if ! command -v docker-compose &> /dev/null; then
    print_error "Docker Compose is not installed. Please install it first:"
    echo "  https://docs.docker.com/compose/install/"
    exit 1
fi

print_status "Docker and Docker Compose are installed"

# Stop any existing containers
print_status "Stopping any existing containers..."
docker-compose down 2>/dev/null || true

# Start the services
print_status "Starting WordPress, MySQL, and phpMyAdmin..."
docker-compose up -d

# Wait for services to be ready
print_status "Waiting for services to start..."
sleep 10

# Check if WordPress is accessible
print_status "Checking if WordPress is accessible..."
if curl -s -o /dev/null -w "%{http_code}" http://localhost:8080 | grep -q "200\|302"; then
    print_success "WordPress is running!"
else
    print_warning "WordPress might still be starting up. Please wait a moment and try again."
fi

# Display information
echo ""
echo "🎉 Docker Installation Summary:"
echo "==============================="
echo "WordPress URL: http://localhost:8080"
echo "phpMyAdmin URL: http://localhost:8081"
echo "MySQL Host: localhost:3306"
echo "MySQL Database: wordpress"
echo "MySQL Username: wordpress"
echo "MySQL Password: wordpress"
echo ""
echo "📋 Next Steps:"
echo "1. Open http://localhost:8080 in your browser"
echo "2. Complete the WordPress setup wizard:"
echo "   - Site Title: DogInvoice"
echo "   - Username: admin"
echo "   - Password: (choose a strong password)"
echo "   - Email: your@email.com"
echo "3. After setup, go to Appearance > Themes"
echo "4. Activate the 'DogInvoice' theme"
echo "5. Install the ACF plugin"
echo "6. Run the data import script"
echo ""
echo "🔧 Useful Commands:"
echo "  Stop services: docker-compose down"
echo "  Start services: docker-compose up -d"
echo "  View logs: docker-compose logs -f"
echo "  Access WordPress container: docker exec -it doginvoice-wordpress bash"
echo "  Access MySQL: docker exec -it doginvoice-mysql mysql -u wordpress -p wordpress"
echo ""

# Check if we can open the browser
if command -v open &> /dev/null; then
    read -p "Would you like to open WordPress in your browser? (y/n): " -n 1 -r
    echo
    if [[ $REPLY =~ ^[Yy]$ ]]; then
        open "http://localhost:8080"
    fi
fi

print_success "Docker installation completed successfully! 🚀"
