#!/bin/bash

# Local GitHub Actions Simulation Script
# This script simulates what will happen in GitHub Actions

echo "🚀 Simulating GitHub Actions workflow locally..."
echo "================================================"

# Step 1: Validate composer.json
echo "📋 Step 1: Validating composer.json..."
composer validate --strict
if [ $? -ne 0 ]; then
    echo "❌ composer.json validation failed!"
    exit 1
fi
echo "✅ composer.json is valid"

# Step 2: Install dependencies
echo ""
echo "📦 Step 2: Installing dependencies..."
composer install --prefer-dist --no-progress --no-interaction
if [ $? -ne 0 ]; then
    echo "❌ Dependency installation failed!"
    exit 1
fi
echo "✅ Dependencies installed successfully"

# Step 4: Run code quality checks
echo ""
echo "🔍 Step 4: Running code quality checks..."

# PHP CodeSniffer
echo "  🧹 Running PHP CodeSniffer..."
composer phpcs
if [ $? -ne 0 ]; then
    echo "❌ PHP CodeSniffer failed!"
    exit 1
fi
echo "✅ PHP CodeSniffer passed"

# PHP CS Fixer
echo "  🎨 Running PHP CS Fixer (dry run)..."
composer cs
if [ $? -ne 0 ]; then
    echo "❌ PHP CS Fixer found issues!"
    echo "💡 Run 'composer cs:fix' to automatically fix issues"
    exit 1
fi
echo "✅ PHP CS Fixer passed"

# PHPStan
echo "  🔬 Running PHPStan static analysis..."
composer phpstan
if [ $? -ne 0 ]; then
    echo "❌ PHPStan found issues!"
    exit 1
fi
echo "✅ PHPStan passed"

# Step 5: Run test suite
echo ""
echo "🧪 Step 5: Running test suite..."
composer test
if [ $? -ne 0 ]; then
    echo "❌ Test suite failed!"
    exit 1
fi
echo "✅ Test suite passed"

# Step 6: Run test with verbose (optional)
echo ""
echo "🔍 Step 6: Running test suite with verbose output..."
composer test:verbose
if [ $? -ne 0 ]; then
    echo "❌ Verbose test failed!"
    exit 1
fi
echo "✅ Verbose test passed"

# Step 7: Check if we can run coverage (optional)
echo ""
echo "📊 Step 7: Checking test coverage capability..."
if command -v vendor/bin/phpunit >/dev/null 2>&1; then
    echo "✅ PHPUnit is available for coverage"
    # Note: Coverage requires xdebug extension
    if php -m | grep -q xdebug; then
        echo "✅ Xdebug is available, running coverage..."
        vendor/bin/phpunit --coverage-text || echo "⚠️  Coverage failed (may need xdebug configuration)"
    else
        echo "⚠️  Xdebug not available, skipping coverage"
    fi
else
    echo "⚠️  PHPUnit not found, skipping coverage"
fi

echo ""
echo "🎉 Local simulation completed successfully!"
echo "Your code is ready for GitHub Actions! 🚀"
