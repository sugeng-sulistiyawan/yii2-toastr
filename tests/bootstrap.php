<?php

/**
 * This file is part of the diecoding/yii2-toastr project.
 * (c) Die Coding! <https://www.diecoding.com/>
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

Yii::setAlias('@tests', __DIR__);

new \yii\console\Application([
    'id' => 'testApp',
    'basePath' => __DIR__
]);
