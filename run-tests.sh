#!/bin/bash

# Simple script to run Pest tests
# Usage: ./run-tests.sh [options]

echo "🧪 Running Pest Tests for Yii2 Toastr..."
echo "========================================="

# Check if Pest is installed
if [ ! -f "./vendor/bin/pest" ]; then
    echo "❌ Pest is not installed. Please run 'composer install' first."
    exit 1
fi

# Run stable tests by default (exclude advanced tests that might have compatibility issues)
if [ $# -eq 0 ]; then
    echo "🎯 Running stable test suite..."
    ./vendor/bin/pest tests/WidgetTest.php tests/ToastrAssetTest.php tests/ToastrFlashTest.php
else
    # Run Pest with any passed arguments
    ./vendor/bin/pest "$@"
fi

echo ""
echo "✅ Test run completed!"
