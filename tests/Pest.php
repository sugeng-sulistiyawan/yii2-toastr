<?php

/**
 * This file is part of the diecoding/yii2-toastr project.
 * Copyright (c) Sugeng Sulistiyawan <sugeng.sulistiyawan@gmail.com>
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

// Bootstrap Yii for testing
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

// Create a minimal Yii application for testing
$config = [
    'id' => 'basic-tests',
    'basePath' => dirname(__DIR__),
];

new yii\console\Application($config);

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

uses(PHPUnit\Framework\TestCase::class)->in(__DIR__);

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeValidToastrType', function () {
    return $this->toBeIn(['success', 'info', 'warning', 'error']);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function createMockYiiApp()
{
    if (!defined('YII_DEBUG')) {
        define('YII_DEBUG', true);
    }
    if (!defined('YII_ENV')) {
        define('YII_ENV', 'test');
    }
    
    // Mock basic Yii application for testing if needed
    return true;
}
