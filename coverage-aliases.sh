#!/bin/bash

# Yii2 Toastr Coverage Aliases
# Source this file to add convenient coverage aliases
# Usage: source coverage-aliases.sh

echo "🎯 Adding Yii2 Toastr coverage aliases..."

# Coverage aliases with PCOV (preferred) or Xdebug fallback
alias test-coverage='composer test:coverage'
alias test-coverage-text='composer test:coverage-text'
alias test-coverage-html='composer test:coverage-html'
alias test-coverage-xml='composer test:coverage-clover'
alias test-coverage-all='composer test:coverage-min'

# Test aliases
alias test-quick='composer test:stable'
alias test-all='composer test:all'
alias test-verbose='composer test:verbose'

# Coverage viewing
alias view-coverage='open coverage-html/index.html 2>/dev/null || xdg-open coverage-html/index.html 2>/dev/null || echo "Open coverage-html/index.html in your browser"'

# Validation
alias validate-coverage='./validate-coverage.sh'

echo "✅ Coverage aliases added!"
echo ""
echo "Available commands:"
echo "  test-coverage       # Generate text + HTML coverage (PCOV)"
echo "  test-coverage-text  # Generate text coverage only (PCOV)"
echo "  test-coverage-html  # Generate HTML coverage only (PCOV)"
echo "  test-coverage-xml   # Generate XML coverage for CI (PCOV)"
echo "  test-coverage-all   # Generate all coverage formats (PCOV)"
echo "  test-quick          # Run stable tests only"
echo "  test-all            # Run all tests"
echo "  test-verbose        # Run tests with verbose output"
echo "  view-coverage       # Open HTML coverage report"
echo "  validate-coverage   # Validate coverage setup"
echo ""
echo "💡 To make these permanent, add to ~/.bashrc:"
echo "   source $(pwd)/coverage-aliases.sh"
