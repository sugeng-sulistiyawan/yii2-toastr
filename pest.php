<?php

/**
 * This file is part of the diecoding/yii2-toastr project.
 * Copyright (c) Sugeng Sulistiyawan <sugeng.sulistiyawan@gmail.com>
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/vendor/yiisoft/yii2/Yii.php';

uses()
    ->group('toastr')
    ->in('tests');
