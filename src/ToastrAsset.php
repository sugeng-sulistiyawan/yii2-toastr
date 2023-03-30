<?php

namespace diecoding\toastr;

use yii\web\AssetBundle;
use yii\web\YiiAsset;

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
     * @inheritdoc
     */
    public $sourcePath = '@npm/toastr/build';

    /**
     * @inheritdoc
     */
    public $css = [
        'toastr.min.css',
    ];

    /**
     * @inheritdoc
     */
    public $js = [
        'toastr.min.js',
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
        YiiAsset::class,
    ];
}
