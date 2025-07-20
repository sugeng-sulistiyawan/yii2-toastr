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

// Create a minimal Yii web application for testing
$config = [
    'id' => 'basic-tests',
    'basePath' => dirname(__DIR__),
    'aliases' => [
        '@webroot' => dirname(__DIR__) . '/tests/runtime',
        '@web' => '/',
    ],
    'components' => [
        'assetManager' => [
            'basePath' => dirname(__DIR__) . '/tests/runtime/assets',
            'baseUrl' => '/assets',
        ],
        'view' => [
            'class' => 'yii\web\View',
        ],
    ],
];

$app = new yii\web\Application($config);

// Override the view component with a mock for testing
$mockView = new class () extends yii\web\View {
    public function registerAssetBundle($name, $position = null)
    {
        // Mock implementation - do nothing
        return null;
    }

    public function registerJs($js, $position = null, $key = null)
    {
        // Mock implementation - do nothing
        return;
    }
};

$app->set('view', $mockView);

/*
|--------------------------------------------------------------------------
| Helper Functions
|--------------------------------------------------------------------------
|
| Helper functions for PHPUnit testing
|
*/

function createMockYiiApp()
{
    if (! defined('YII_DEBUG')) {
        define('YII_DEBUG', true);
    }
    if (! defined('YII_ENV')) {
        define('YII_ENV', 'test');
    }

    // Mock basic Yii application for testing if needed
    return true;
}
