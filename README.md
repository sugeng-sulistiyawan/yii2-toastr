# Yii2 Toastr

Simple flash toastr notifications for Yii2

[![Latest Stable Version](https://img.shields.io/packagist/v/diecoding/yii2-toastr?label=stable)](https://packagist.org/packages/diecoding/yii2-toastr)
[![Total Downloads](https://img.shields.io/packagist/dt/diecoding/yii2-toastr)](https://packagist.org/packages/diecoding/yii2-toastr)
[![Monthly Downloads](https://img.shields.io/packagist/dm/diecoding/yii2-toastr)](https://packagist.org/packages/diecoding/yii2-toastr)
[![Latest Stable Release Date](https://img.shields.io/github/release-date/wanforge/yii2-toastr)](https://github.com/wanforge/yii2-toastr)

[![Tests](https://github.com/wanforge/yii2-toastr/actions/workflows/tests.yml/badge.svg)](https://github.com/wanforge/yii2-toastr/actions/workflows/tests.yml)
[![codecov](https://codecov.io/gh/wanforge/yii2-toastr/branch/master/graph/badge.svg)](https://codecov.io/gh/wanforge/yii2-toastr)
[![Coverage Status](https://img.shields.io/codecov/c/github/wanforge/yii2-toastr/master?label=coverage)](https://codecov.io/gh/wanforge/yii2-toastr)
[![Code Quality](https://img.shields.io/github/actions/workflow/status/wanforge/yii2-toastr/tests.yml?branch=master&label=code%20quality)](https://github.com/wanforge/yii2-toastr/actions/workflows/tests.yml)

[![PHPStan Level](https://img.shields.io/badge/PHPStan-level%203-brightgreen.svg)](https://github.com/wanforge/yii2-toastr/actions/workflows/tests.yml)
[![PHP CS Fixer](https://img.shields.io/badge/PHP%20CS%20Fixer-PSR--12-brightgreen.svg)](https://github.com/wanforge/yii2-toastr/actions/workflows/tests.yml)
[![License](https://img.shields.io/github/license/wanforge/yii2-toastr)](https://github.com/wanforge/yii2-toastr)
[![PHP Version Require](https://img.shields.io/packagist/dependency-v/diecoding/yii2-toastr/php?color=6f73a6)](https://packagist.org/packages/diecoding/yii2-toastr)

[![GitHub Issues](https://img.shields.io/github/issues/wanforge/yii2-toastr)](https://github.com/wanforge/yii2-toastr/issues)
[![GitHub Stars](https://img.shields.io/github/stars/wanforge/yii2-toastr)](https://github.com/wanforge/yii2-toastr/stargazers)
[![GitHub Forks](https://img.shields.io/github/forks/wanforge/yii2-toastr)](https://github.com/wanforge/yii2-toastr/network/members)

> Yii2 Toastr uses [Toastr](https://codeseven.github.io/toastr/) <br> Demo: <https://codeseven.github.io/toastr/demo.html>

## Table of Contents

- [Yii2 Toastr](#yii2-toastr)
  - [Table of Contents](#table-of-contents)
  - [Status](#status)
    - [📊 **Quality Metrics**](#-quality-metrics)
    - [🎯 **Badge Meanings**](#-badge-meanings)
  - [Installation](#installation)
  - [Dependencies](#dependencies)
  - [Usage](#usage)
    - [Layouts/Views](#layoutsviews)
      - [Layouts/Views Simple Usage](#layoutsviews-simple-usage)
      - [Layouts/Views Advanced Usage](#layoutsviews-advanced-usage)
    - [Controllers](#controllers)
      - [Controllers Simple Usage](#controllers-simple-usage)
      - [Controllers Advanced Usage (\< v1.4.0)](#controllers-advanced-usage--v140)
      - [Controllers Advanced Usage With Override Toastr Options (≥ v1.4.0)](#controllers-advanced-usage-with-override-toastr-options--v140)
  - [Testing](#testing)
    - [Test Coverage](#test-coverage)
  - [Code Quality](#code-quality)
  - [Contributing](#contributing)
  - [License](#license)
  - [Credits](#credits)

## Status

This project maintains high quality standards with comprehensive testing and automated quality assurance:

### 📊 **Quality Metrics**

- **✅ Tests**: 62 tests, 243 assertions across PHP 7.4-8.3
- **✅ Coverage**: Real-time coverage tracking via Codecov  
- **✅ Static Analysis**: PHPStan level 3 - strict type checking
- **✅ Code Style**: PSR-12 compliant via PHP CS Fixer
- **✅ Standards**: PHP CodeSniffer validation
- **✅ CI/CD**: Fully automated via GitHub Actions

### 🎯 **Badge Meanings**

- **Tests Badge** - Shows current test status (passing/failing)
- **Coverage Badges** - Display code coverage percentage from Codecov
- **Code Quality Badge** - Overall GitHub Actions workflow status
- **PHPStan Badge** - Static analysis level (level 3 = strict)
- **PHP CS Fixer Badge** - Code style standard (PSR-12)
- **Download Badges** - Packagist usage statistics
- **Version Badges** - Latest stable release information

All quality metrics are automatically verified on every commit and pull request, ensuring consistent high-quality code.

## Installation

Package is available on [Packagist](https://packagist.org/packages/diecoding/yii2-toastr), you can install it using [Composer](https://getcomposer.org).

```shell
composer require diecoding/yii2-toastr "^1.0"
```

or add to the require section of your `composer.json` file.

```shell
"diecoding/yii2-toastr": "^1.0"
```

## Dependencies

- PHP 7.4+
- [yiisoft/yii2](https://github.com/yiisoft/yii2)
- [npm-asset/toastr](https://asset-packagist.org/package/npm-asset/toastr)

## Usage

### Layouts/Views

> Add `ToastrFlash` to your layout or view file, example in file `views\layouts\main.php`

#### Layouts/Views Simple Usage

```php
use diecoding\toastr\ToastrFlash;

ToastrFlash::widget();
```

#### Layouts/Views Advanced Usage

```php
use diecoding\toastr\ToastrFlash;

ToastrFlash::widget([
    "typeDefault"       => ToastrFlash::TYPE_INFO,            // (string) default `ToastrFlash::TYPE_INFO`
    "titleDefault"      => "",                                // (string) default `""`
    "messageDefault"    => "",                                // (string) default `""`
    "closeButton"       => false,                             // (bool) default `false`
    "debug"             => false,                             // (bool) default `false`
    "newestOnTop"       => true,                              // (bool) default `true`
    "progressBar"       => true,                              // (bool) default `true`
    "positionClass"     => ToastrFlash::POSITION_TOP_RIGHT,   // (string) default `ToastrFlash::POSITION_TOP_RIGHT`
    "preventDuplicates" => true,                              // (bool) default `true`
    "showDuration"      => 300,                               // (int|null) default `300` in `ms`, `null` for skip
    "hideDuration"      => 1000,                              // (int|null) default `1000` in `ms`, `null` for skip
    "timeOut"           => 5000,                              // (int|null) default `5000` in `ms`, `null` for skip
    "extendedTimeOut"   => 1000,                              // (int|null) default `1000` in `ms`, `null` for skip
    "showEasing"        => "swing",                           // (string) default `swing`, `swing` and `linear` are built into jQuery
    "hideEasing"        => "swing",                           // (string) default `swing`, `swing` and `linear` are built into jQuery
    "showMethod"        => "slideDown",                       // (string) default `slideDown`, `fadeIn`, `slideDown`, and `show` are built into jQuery
    "hideMethod"        => "slideUp",                         // (string) default `slideUp`, `hide`, `fadeOut` and `slideUp` are built into jQuery
    "tapToDismiss"      => true,                              // (bool) default `true`
    "escapeHtml"        => true,                              // (bool) default `true`
    "rtl"               => false,                             // (bool) default `false`
    "skipCoreAssets"    => false,                             // (bool) default `false`, `true` if use custom or external toastr assets
    "options"           => [],                                // (array) default `[]`, Custom Toastr options and override default options
]);
```

### Controllers

> Just use `Yii::$app->session->setFlash($type, $message)` like as usual alert

#### Controllers Simple Usage

```php
Yii::$app->session->setFlash('error', 'Message');
```

or if use multiple flash in same session

```php
Yii::$app->session->setFlash('error', [(string) 'Message 1', (string) 'Message 2', (string) 'Message 3']);
```

#### Controllers Advanced Usage (< v1.4.0)

```php
Yii::$app->session->setFlash('error', [[(string) 'Title', (string) 'Message']]);
```

or if use multiple flash in same session

```php
Yii::$app->session->setFlash('error', [['Title 1', 'Message 1'], ['Title 2', 'Message 2'], ['Title 3', 'Message 3']]);
```

#### Controllers Advanced Usage With Override Toastr Options (≥ v1.4.0)

```php
Yii::$app->session->setFlash('error', [[(string) 'Title', (string) 'Message', (array) 'Options']]);

// or

Yii::$app->session->setFlash('error', [['title' => (string) 'Title', 'message' => (string) 'Message', 'options' => (array) 'Options']]);
```

or if use multiple flash in same session

```php
Yii::$app->session->setFlash('error', [
  [
    'Title 1', 
    'Message 1', 
    [
        "progressBar"     => true,
        "showDuration"    => 300,
        "hideDuration"    => 10000,
        "timeOut"         => 5000,
        "extendedTimeOut" => 1000,
    ]
  ],
  [
    'title' => 'Title 2', 
    'message' => 'Message 2', 
    'options' => [
        "progressBar"  => false,
        "hideDuration" => 10000,
    ]
  ],
  ['Title 3', 'Message 3'], 
  ['Message 4'],
  [
    'message' => 'Message 5', 
    'options' => [
        "progressBar" => false,
    ]
  ],
  [
    'title' => 'Title 6', 
    'options' => [
        "timeOut" => 50000,
    ]
  ],
]);
```

## Testing

This package uses [PHPUnit](https://phpunit.de/) for testing. To run the tests:

```bash
# Install dependencies
composer install

# Run tests
composer test

# Run all tests (including experimental)
composer test:all

# Run tests with verbose output
composer test:verbose

# Run tests with coverage
composer test:coverage
```

### Test Coverage

Generate code coverage reports:

```bash
# Text coverage report (using PCOV)
composer test:coverage-text

# HTML coverage report (using PCOV)
composer test:coverage-html

# Clover XML coverage for CI (using PCOV)
composer test:coverage-clover

# All coverage formats (using PCOV)
composer test:coverage-min
```

**Quick Setup for Coverage:**

```bash
# Install PCOV for fast coverage (recommended)
sudo apt install php-pcov

# Then run any coverage command
composer test:coverage-html

# View HTML report
open coverage-html/index.html  # or your browser
```

The test suite covers:

- ✅ **ToastrBase** - Base widget functionality and constants
- ✅ **Toastr** - Main notification widget properties and methods
- ✅ **ToastrFlash** - Flash message integration
- ✅ **ToastrAsset** - Asset bundle configuration

**Coverage Requirements:**

- HTML reports: `coverage-html/index.html`
- Requires **PCOV** (recommended) or **Xdebug** extension for coverage generation
- PCOV is faster and more efficient than Xdebug for coverage
- Target coverage: **>80%** for new features

All tests are automatically run on multiple PHP versions (7.4, 8.0, 8.1, 8.2, 8.3) via GitHub Actions with coverage reporting.

## Code Quality

This project uses modern code quality tools integrated with GitHub Actions:

- **PHP CodeSniffer** - PSR-12 coding standards
- **PHP CS Fixer** - Modern PHP code style
- **PHPStan** - Static analysis (level 3)

```bash
composer quality      # Run all code quality checks
composer cs           # Check code style
composer cs:fix       # Auto-fix code style
composer phpcs        # Check coding standards  
composer phpcs:fix    # Auto-fix coding standards
composer phpstan      # Run static analysis
```

## Contributing

We welcome contributions! Please follow these steps:

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Make your changes
4. Run quality checks (`composer quality`)
5. Run tests to ensure everything works (`composer test`)
6. Commit your changes (`git commit -am 'Add some amazing feature'`)
7. Push to the branch (`git push origin feature/amazing-feature`)
8. Open a Pull Request

Please make sure to:

- Write tests for new features
- Follow PSR-12 coding standards
- Run code quality checks before submitting
- Update documentation as needed

## License

This package is open-sourced software licensed under the [MIT License](LICENSE).

## Credits

- **Author**: [Sugeng Sulistiyawan](https://github.com/wanforge)
- **Copyright**: Copyright (c) 2018-2025 Sugeng Sulistiyawan
- **Link**: <https://github.com/wanforge>

Built with ❤️ for the Yii2 community.
