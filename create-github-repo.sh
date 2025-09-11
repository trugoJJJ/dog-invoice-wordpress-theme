#!/bin/bash

# 🚀 DogInvoice WordPress Theme - GitHub Repository Creator
# This script will create a GitHub repository and push the code

set -e

echo "🚀 Creating GitHub Repository for DogInvoice WordPress Theme..."

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

# Repository details
REPO_NAME="dog-invoice-wordpress-theme"
REPO_DESCRIPTION="WordPress theme for DogInvoice - AI-powered invoice management system with ACF integration"
REPO_URL="https://github.com/trugoJJJ/$REPO_NAME.git"

print_status "Repository will be created as: $REPO_URL"

# Check if GitHub CLI is installed
if command -v gh &> /dev/null; then
    print_status "GitHub CLI is installed. Creating repository..."
    
    # Check if user is logged in
    if gh auth status &> /dev/null; then
        print_status "GitHub CLI is authenticated"
        
        # Create repository
        gh repo create "$REPO_NAME" \
            --public \
            --description "$REPO_DESCRIPTION" \
            --source=. \
            --remote=origin \
            --push
        
        print_success "Repository created and code pushed to GitHub!"
        print_success "Repository URL: https://github.com/trugoJJJ/$REPO_NAME"
        
    else
        print_warning "GitHub CLI is not authenticated. Please log in:"
        echo "  gh auth login"
        echo "  Then run this script again."
        exit 1
    fi
    
else
    print_warning "GitHub CLI is not installed. Using manual method..."
    
    # Check if curl is available
    if ! command -v curl &> /dev/null; then
        print_error "curl is not installed. Please install it first."
        exit 1
    fi
    
    print_status "Please follow these steps to create the repository:"
    echo ""
    echo "1. Go to: https://github.com/trugoJJJ"
    echo "2. Click 'New repository' (green button)"
    echo "3. Fill in:"
    echo "   - Repository name: $REPO_NAME"
    echo "   - Description: $REPO_DESCRIPTION"
    echo "   - Visibility: Public"
    echo "   - Initialize with: ❌ (don't check anything)"
    echo "4. Click 'Create repository'"
    echo ""
    
    # Wait for user to create repository
    read -p "Press Enter after you've created the repository on GitHub..."
    
    # Try to push to the repository
    print_status "Pushing code to GitHub..."
    
    if git push -u origin main; then
        print_success "Code pushed to GitHub successfully!"
        print_success "Repository URL: https://github.com/trugoJJJ/$REPO_NAME"
    else
        print_error "Failed to push to GitHub. Please check:"
        echo "1. Repository exists on GitHub"
        echo "2. Remote origin is set correctly"
        echo "3. You have push permissions"
        echo ""
        echo "Manual commands:"
        echo "  git remote add origin $REPO_URL"
        echo "  git push -u origin main"
    fi
fi

echo ""
echo "🎉 Repository Setup Complete!"
echo "============================="
echo "Repository URL: https://github.com/trugoJJJ/$REPO_NAME"
echo "Clone URL: $REPO_URL"
echo ""
echo "📋 Next Steps:"
echo "1. Install WordPress using one of the scripts:"
echo "   - Docker: ./install-docker.sh"
echo "   - Local: ./install-wordpress.sh"
echo "2. Activate the DogInvoice theme"
echo "3. Install ACF plugin"
echo "4. Import sample data"
echo ""
echo "📖 Documentation:"
echo "- README.md - Complete documentation"
echo "- install-guide.md - Installation guide"
echo "- wordpress-setup.md - WordPress setup options"
echo ""

print_success "GitHub repository setup completed! 🚀"
