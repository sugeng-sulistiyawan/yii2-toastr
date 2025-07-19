#!/bin/bash

# Coverage validation script
# This script checks if coverage can be generated and provides setup guidance

echo "🔍 Code Coverage Setup Validator"
echo "================================="

# Check PHP version
echo "📋 PHP Version:"
php --version | head -n 1

# Check for coverage extensions
echo ""
echo "🧩 Coverage Extensions:"

XDEBUG_AVAILABLE=$(php -m | grep -i xdebug || echo "")
PCOV_AVAILABLE=$(php -m | grep -i pcov || echo "")

if [ -n "$PCOV_AVAILABLE" ]; then
    echo "✅ PCOV extension found (recommended for coverage)"
    COVERAGE_READY="pcov"
elif [ -n "$XDEBUG_AVAILABLE" ]; then
    echo "✅ Xdebug extension found"
    XDEBUG_MODE=$(php -r "echo ini_get('xdebug.mode');" 2>/dev/null || echo "unknown")
    echo "   Mode: $XDEBUG_MODE"
    if [ "$XDEBUG_MODE" = "coverage" ] || [[ "$XDEBUG_MODE" == *"coverage"* ]]; then
        echo "   ✅ Coverage mode enabled"
        COVERAGE_READY="xdebug"
    else
        echo "   ⚠️  Coverage mode not enabled (set XDEBUG_MODE=coverage)"
    fi
else
    echo "❌ No coverage extensions found (PCOV or Xdebug required)"
    echo ""
    echo "💡 Installation Guide:"
    echo "   PCOV (recommended): sudo apt install php-pcov"
    echo "   Xdebug:             sudo apt install php-xdebug"
    echo ""
fi

# Test basic functionality
echo ""
echo "🧪 Test Suite Status:"
if composer test:stable >/dev/null 2>&1; then
    echo "✅ Test suite passes"
else
    echo "❌ Test suite fails - fix tests before checking coverage"
    exit 1
fi

# Test coverage if available
if [ -n "$COVERAGE_READY" ]; then
    echo ""
    echo "📊 Coverage Test:"
    
    if [ "$COVERAGE_READY" = "pcov" ]; then
        echo "Using PCOV for coverage (fast and efficient)..."
        if composer test:coverage-text >/dev/null 2>&1; then
            echo "✅ Coverage generation works"
            echo ""
            echo "🎯 Available coverage commands:"
            echo "   composer test:coverage-text    # Text report"
            echo "   composer test:coverage-html    # HTML report"
            echo "   composer test:coverage-clover  # XML report"
            echo "   composer test:coverage         # Text + HTML"
            echo "   composer test:coverage-min     # All formats"
        else
            echo "❌ Coverage generation failed"
        fi
    elif [ "$COVERAGE_READY" = "xdebug" ]; then
        echo "Using Xdebug for coverage..."
        export XDEBUG_MODE=coverage
        if XDEBUG_MODE=coverage composer test:coverage-text >/dev/null 2>&1; then
            echo "✅ Coverage generation works"
            echo ""
            echo "🎯 Available coverage commands:"
            echo "   XDEBUG_MODE=coverage composer test:coverage-text    # Text report"
            echo "   XDEBUG_MODE=coverage composer test:coverage-html    # HTML report"
            echo "   XDEBUG_MODE=coverage composer test:coverage-clover  # XML report"
            echo "   XDEBUG_MODE=coverage composer test:coverage         # Text + HTML"
            echo "   XDEBUG_MODE=coverage composer test:coverage-min     # All formats"
            echo ""
            echo "💡 Tip: Add 'export XDEBUG_MODE=coverage' to your shell profile"
        else
            echo "❌ Coverage generation failed"
        fi
    fi
elif [ -n "$PCOV_AVAILABLE" ]; then
    echo ""
    echo "📊 Coverage Test:"
    echo "✅ PCOV found and ready to use"
    echo ""
    echo "🎯 Available coverage commands:"
    echo "   composer test:coverage-text    # Text report"
    echo "   composer test:coverage-html    # HTML report"
    echo "   composer test:coverage-clover  # XML report"
    echo "   composer test:coverage         # Text + HTML"
    echo "   composer test:coverage-min     # All formats"
elif [ -n "$XDEBUG_AVAILABLE" ]; then
    echo ""
    echo "📊 Coverage Test:"
    echo "✅ Xdebug found but needs coverage mode enabled"
    echo ""
    echo "🎯 Try with coverage mode:"
    echo "   XDEBUG_MODE=coverage composer test:coverage-text"
    echo ""
    echo "💡 To enable permanently, add to ~/.bashrc:"
    echo "   export XDEBUG_MODE=coverage"
    echo ""
    echo "💡 Consider installing PCOV for faster coverage:"
    echo "   sudo apt install php-pcov"
else
    echo ""
    echo "⚠️  Coverage not available - install PCOV or Xdebug extension"
fi

echo ""
echo "📁 Coverage output files (when generated):"
echo "   📄 coverage.txt       # Text report"
echo "   📄 coverage.xml       # Clover XML"
echo "   📁 coverage-html/     # HTML report directory"
echo "   📄 junit.xml          # Test results XML"

echo ""
echo "🎉 Coverage setup validation completed!"
