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

# Step 3: Run test suite
echo ""
echo "🧪 Step 3: Running test suite..."
composer test
if [ $? -ne 0 ]; then
    echo "❌ Test suite failed!"
    exit 1
fi
echo "✅ Test suite passed"

# Step 4: Run test with verbose (optional)
echo ""
echo "🔍 Step 4: Running test suite with verbose output..."
composer test:verbose
if [ $? -ne 0 ]; then
    echo "❌ Verbose test failed!"
    exit 1
fi
echo "✅ Verbose test passed"

# Step 5: Check if we can run coverage (optional)
echo ""
echo "📊 Step 5: Checking test coverage capability..."
if command -v vendor/bin/pest >/dev/null 2>&1; then
    echo "✅ Pest is available for coverage"
    # Note: Coverage requires xdebug extension
    if php -m | grep -q xdebug; then
        echo "✅ Xdebug is available, running coverage..."
        vendor/bin/pest --coverage || echo "⚠️  Coverage failed (may need xdebug configuration)"
    else
        echo "⚠️  Xdebug not available, skipping coverage"
    fi
else
    echo "⚠️  Pest not found, skipping coverage"
fi

echo ""
echo "🎉 Local simulation completed successfully!"
echo "Your code is ready for GitHub Actions! 🚀"
