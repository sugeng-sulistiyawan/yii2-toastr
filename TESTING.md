# Testing Guide for Yii2 Toastr

This document provides comprehensive information about testing the Yii2 Toastr package.

## Testing Framework

This project uses **PHPUnit** for testing instead of Pest for better compatibility and industry standard practices.

## Running Tests

### Basic Test Commands

```bash
# Run all tests
composer test

# Run stable tests only (recommended for CI)
composer test:stable

# Run all tests including experimental ones
composer test:all

# Run tests with verbose output
composer test:verbose
```

### Coverage Commands

```bash
# Generate text and HTML coverage reports (using PCOV)
composer test:coverage

# Generate all coverage formats (text, clover, HTML) (using PCOV)
composer test:coverage-min

# Generate text coverage only (using PCOV)
composer test:coverage-text

# Generate clover XML coverage (for CI) (using PCOV)
composer test:coverage-clover

# Generate HTML coverage report (using PCOV)
composer test:coverage-html
```

### Shell Scripts

```bash
# Run stable test suite
./run-tests.sh

# Simulate CI environment
./simulate-ci.sh
```

## Code Coverage

### Prerequisites

To generate code coverage reports, you need one of the following PHP extensions:

#### Option 1: PCOV (Recommended - Faster)

```bash
# Install PCOV extension
sudo apt install php-pcov

# Or on CentOS/RHEL
sudo yum install php-pcov

# Or via PECL
pecl install pcov
```

#### Option 2: Xdebug (More Features)

```bash
# Ubuntu/Debian
sudo apt install php-xdebug

# CentOS/RHEL
sudo yum install php-xdebug

# macOS with Homebrew
brew install php@8.4-xdebug
```

### Coverage Configuration

The PHPUnit configuration (`phpunit.xml.dist`) includes:

- **Include**: `./src/` directory (source code)
- **Exclude**: `./vendor/` and `./tests/` directories
- **Reports**:
  - HTML report: `coverage-html/` directory
  - Text report: `coverage.txt` file
  - Clover XML: `coverage.xml` file

### Coverage Thresholds

- **Low coverage**: < 50% (red)
- **Medium coverage**: 50-80% (yellow)
- **High coverage**: > 80% (green)

### Viewing Coverage Reports

#### HTML Report

After running `composer test:coverage-html`, open:

```
coverage-html/index.html
```

#### Text Report

```bash
composer test:coverage-text
```

#### CI Integration

Use clover XML format for CI services:

```bash
composer test:coverage-clover
```

## Test Structure

### Test Files

- `tests/WidgetTest.php` - Core widget functionality tests
- `tests/ToastrAssetTest.php` - Asset bundle tests
- `tests/ToastrFlashTest.php` - Flash message widget tests
- `tests/AdvancedTest.php` - Advanced testing scenarios

### Test Categories

Tests are organized using PHPUnit groups:

```bash
# Run validation tests only
./vendor/bin/phpunit --group validation

# Run performance tests only
./vendor/bin/phpunit --group performance
```

## Continuous Integration

### Local CI Simulation

```bash
./simulate-ci.sh
```

This script simulates the GitHub Actions workflow:

1. Validates `composer.json`
2. Installs dependencies
3. Runs test suite
4. Runs verbose tests
5. Checks coverage capability

### GitHub Actions Integration

The project is configured for GitHub Actions with:

- Multiple PHP versions testing
- Dependency caching
- Coverage reporting
- Artifact storage

## Troubleshooting

### No Coverage Driver Available

**Error**: `Warning: No code coverage driver available`

**Solution**: Install Xdebug or PCOV extension:

```bash
# Check available extensions
php -m | grep -E "(xdebug|pcov)"

# Install Xdebug
sudo apt install php-xdebug

# Or install PCOV
sudo apt install php-pcov
```

### Memory Issues

If you encounter memory issues during testing:

```bash
# Increase PHP memory limit
php -d memory_limit=512M vendor/bin/phpunit
```

### Slow Tests

For faster test execution:

- Use PCOV instead of Xdebug for coverage
- Run stable tests only: `composer test:stable`
- Skip coverage during development

## Best Practices

### Writing Tests

1. Use descriptive test method names
2. Follow the Arrange-Act-Assert pattern
3. Use data providers for parameterized tests
4. Group related tests with `@group` annotation
5. Mark incomplete tests with `@doesNotPerformAssertions`

### Coverage Guidelines

1. Aim for > 80% code coverage
2. Test edge cases and error conditions
3. Test public APIs thoroughly
4. Don't obsess over 100% coverage
5. Focus on meaningful tests over coverage metrics

### Performance

1. Keep tests fast and focused
2. Use mocks for external dependencies
3. Clean up after tests (database, files, etc.)
4. Use separate test databases/environments

## Files Generated

Coverage and test reports generate these files (all are gitignored):

- `coverage-html/` - HTML coverage report directory
- `coverage.xml` - Clover XML coverage report
- `coverage.txt` - Text coverage report
- `junit.xml` - JUnit test results XML
- `.phpunit.result.cache` - PHPUnit cache file

## Migration from Pest

This project was migrated from Pest to PHPUnit. Key changes:

- Test functions converted to class methods
- `expect()` assertions converted to `$this->assert*()`
- Data providers replace Pest datasets
- Groups replace Pest tags
- Bootstrap simplified for PHPUnit

## Contributing

When contributing tests:

1. Run the full test suite: `composer test:all`
2. Ensure coverage doesn't decrease: `composer test:coverage`
3. Follow existing test patterns
4. Update this documentation if adding new test categories
