<?php

namespace diecoding\yii2\toastr;

use yii\web\AssetBundle;

/**
 * ToastrAsset represents a collection of asset files, such as CSS, JS, images.
 * 
 * @link [sugeng-sulistiyawan.github.io](sugeng-sulistiyawan.github.io)
 * @author Sugeng Sulistiyawan <sugeng.sulistiyawan@gmail.com>
 * @copyright Copyright (c) 2023
 */
class ToastrAsset extends AssetBundle
{
    /**
     * @var string $sourcePath
     */
    public $sourcePath = '@bower/toastr';

    /**
     * @var array $css
     */
    public $css = [
        YII_ENV_DEV ? 'toastr.css' : 'toastr.min.css',
    ];

    /**
     * @var array $js
     */
    public $js = [
        YII_ENV_DEV ? 'toastr.js' : 'toastr.min.js',
    ];

    /**
     * @var array $depends
     */
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
