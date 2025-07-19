#!/bin/bash

# Simple script to run PHPUnit tests
# Usage: ./run-tests.sh [options]

echo "🧪 Running PHPUnit Tests for Yii2 Toastr..."
echo "==========================================="

# Check if PHPUnit is installed
if [ ! -f "./vendor/bin/phpunit" ]; then
    echo "❌ PHPUnit is not installed. Please run 'composer install' first."
    exit 1
fi

# Run stable tests by default (exclude advanced tests that might have compatibility issues)
if [ $# -eq 0 ]; then
    echo "🎯 Running stable test suite..."
    ./vendor/bin/phpunit tests/WidgetTest.php tests/ToastrAssetTest.php tests/ToastrFlashTest.php
else
    # Run PHPUnit with any passed arguments
    ./vendor/bin/phpunit "$@"
fi

echo ""
echo "✅ Test run completed!"
