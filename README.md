# Yii2 Toastr

Simple flash toastr notifications for Yii2

[![Latest Stable Version](https://img.shields.io/packagist/v/diecoding/yii2-toastr?label=stable)](https://packagist.org/packages/diecoding/yii2-toastr)
[![PHP Version Require](https://img.shields.io/packagist/dependency-v/diecoding/yii2-toastr/php?color=6f73a6)](https://packagist.org/packages/diecoding/yii2-toastr)
[![Total Downloads](https://img.shields.io/packagist/dt/diecoding/yii2-toastr)](https://packagist.org/packages/diecoding/yii2-toastr)
[![License](https://img.shields.io/github/license/wanforge/yii2-toastr)](https://github.com/wanforge/yii2-toastr)

[![Tests](https://github.com/wanforge/yii2-toastr/actions/workflows/tests.yml/badge.svg)](https://github.com/wanforge/yii2-toastr/actions/workflows/tests.yml)
[![Coverage Status](https://codecov.io/gh/wanforge/yii2-toastr/branch/master/graph/badge.svg)](https://codecov.io/gh/wanforge/yii2-toastr)
[![PHPStan Level](https://img.shields.io/badge/PHPStan-level%205-brightgreen.svg)](https://github.com/wanforge/yii2-toastr/actions/workflows/tests.yml)
[![PHP CS Fixer](https://img.shields.io/badge/PHP%20CS%20Fixer-PSR--12-brightgreen.svg)](https://github.com/wanforge/yii2-toastr/actions/workflows/tests.yml)

> Yii2 Toastr uses [Toastr](https://codeseven.github.io/toastr/) library  
> **Demo**: <https://codeseven.github.io/toastr/demo.html>

## Table of Contents

- [Yii2 Toastr](#yii2-toastr)
  - [Table of Contents](#table-of-contents)
  - [Installation](#installation)
  - [Dependencies](#dependencies)
  - [Usage](#usage)
    - [Layouts/Views](#layoutsviews)
      - [Basic Usage](#basic-usage)
      - [Advanced Configuration](#advanced-configuration)
    - [Controllers](#controllers)
      - [Simple Flash Messages](#simple-flash-messages)
      - [Multiple Messages](#multiple-messages)
      - [Messages with Titles (\< v1.4.0)](#messages-with-titles--v140)
      - [Advanced Usage with Custom Options (≥ v1.4.0)](#advanced-usage-with-custom-options--v140)
      - [Complex Example with Multiple Messages](#complex-example-with-multiple-messages)
  - [Testing](#testing)
  - [Code Quality](#code-quality)
  - [Contributing](#contributing)
  - [License](#license)

## Installation

Install via [Composer](https://getcomposer.org):

```bash
composer require diecoding/yii2-toastr "^1.0"
```

Or add to your `composer.json`:

```json
{
    "require": {
        "diecoding/yii2-toastr": "^1.0"
    }
}
```

## Dependencies

- PHP 7.4+
- [yiisoft/yii2](https://github.com/yiisoft/yii2) (≥2.0.14)
- [npm-asset/toastr](https://asset-packagist.org/package/npm-asset/toastr)

## Usage

### Layouts/Views

Add `ToastrFlash` widget to your layout file (e.g., `views/layouts/main.php`):

#### Basic Usage

```php
use diecoding\toastr\ToastrFlash;

ToastrFlash::widget();
```

#### Advanced Configuration

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

Use the standard Yii2 flash message system:

#### Simple Flash Messages

```php
// Single message
Yii::$app->session->setFlash('error', 'Something went wrong!');
Yii::$app->session->setFlash('success', 'Operation completed successfully!');
Yii::$app->session->setFlash('info', 'Information message');
Yii::$app->session->setFlash('warning', 'Warning message');
```

#### Multiple Messages

```php
Yii::$app->session->setFlash('error', [
    'Message 1',
    'Message 2', 
    'Message 3'
]);
```

#### Messages with Titles (< v1.4.0)

```php
Yii::$app->session->setFlash('error', [
    ['Title', 'Message']
]);

// Multiple messages with titles
Yii::$app->session->setFlash('error', [
    ['Title 1', 'Message 1'], 
    ['Title 2', 'Message 2'], 
    ['Title 3', 'Message 3']
]);
```

#### Advanced Usage with Custom Options (≥ v1.4.0)

```php
// Array format
Yii::$app->session->setFlash('error', [
    ['Title', 'Message', ['timeOut' => 10000]]
]);

// Associative array format
Yii::$app->session->setFlash('error', [
    [
        'title' => 'Custom Title',
        'message' => 'Custom message',
        'options' => [
            'progressBar' => true,
            'timeOut' => 5000,
            'hideDuration' => 1000
        ]
    ]
]);
```

#### Complex Example with Multiple Messages

```php
Yii::$app->session->setFlash('info', [
    [
        'title' => 'Step 1 Complete', 
        'message' => 'Data validation passed', 
        'options' => ['progressBar' => true, 'timeOut' => 5000]
    ],
    [
        'title' => 'Step 2 Complete', 
        'message' => 'Data saved successfully',
        'options' => ['progressBar' => false, 'timeOut' => 3000]
    ],
    ['Simple message without custom options']
]);
```

## Testing

Run the test suite using [PHPUnit](https://phpunit.de/):

```bash
# Install dependencies
composer install

# Run tests
composer test

# Run tests with coverage (requires PCOV or Xdebug)
composer test:coverage

# Generate HTML coverage report
composer test:coverage-html
```

The test suite covers:

- ✅ **ToastrBase** - Base widget functionality and constants
- ✅ **Toastr** - Main notification widget properties and methods  
- ✅ **ToastrFlash** - Flash message integration
- ✅ **ToastrAsset** - Asset bundle configuration

**Coverage Requirements:**

- Target: >80% code coverage
- Supports PHP 7.4, 8.0, 8.1, 8.2, 8.3
- Automated testing via GitHub Actions

## Code Quality

This project maintains high standards through automated quality checks:

- **PHP CodeSniffer** - PSR-12 coding standards
- **PHP CS Fixer** - Modern PHP code formatting
- **PHPStan** - Static analysis (level 5)

```bash
# Run all quality checks
composer quality

# Individual commands
composer cs           # Check code style
composer cs:fix       # Auto-fix code style  
composer phpstan      # Run static analysis
```

## Contributing

Contributions are welcome! Please follow these steps:

1. **Fork** the repository
2. **Create** a feature branch (`git checkout -b feature/amazing-feature`)
3. **Make** your changes
4. **Run** quality checks (`composer quality`)
5. **Run** tests (`composer test`)
6. **Commit** your changes (`git commit -am 'Add amazing feature'`)
7. **Push** to the branch (`git push origin feature/amazing-feature`)
8. **Open** a Pull Request

**Requirements:**

- Write tests for new features
- Follow PSR-12 coding standards
- Ensure all quality checks pass
- Update documentation as needed

## License

This package is open-source software licensed under the [MIT License](LICENSE).

---

**Author**: [Sugeng Sulistiyawan](https://github.com/wanforge)  
**Copyright**: © 2018-2025 Sugeng Sulistiyawan  

Built with ❤️ for the Yii2 community.
