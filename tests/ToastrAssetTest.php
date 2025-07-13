<?php

/**
 * ToastrAsset Tests using Pest
 */

use diecoding\toastr\ToastrAsset;
use yii\web\AssetBundle;

test('ToastrAsset class exists', function () {
    expect(class_exists(ToastrAsset::class))->toBeTrue();
});

test('ToastrAsset extends AssetBundle', function () {
    $reflection = new ReflectionClass(ToastrAsset::class);
    expect($reflection->getParentClass()->getName())->toBe(AssetBundle::class);
});

test('ToastrAsset has required properties', function () {
    $reflection = new ReflectionClass(ToastrAsset::class);
    expect($reflection->hasProperty('sourcePath'))->toBeTrue();
    expect($reflection->hasProperty('css'))->toBeTrue();
    expect($reflection->hasProperty('js'))->toBeTrue();
    expect($reflection->hasProperty('depends'))->toBeTrue();
});
