<?php

/**
 * ToastrAsset Tests using PHPUnit
 */

namespace diecoding\toastr\tests;

use PHPUnit\Framework\TestCase;
use diecoding\toastr\ToastrAsset;
use yii\web\AssetBundle;
use ReflectionClass;

class ToastrAssetTest extends TestCase
{
    public function testToastrAssetClassExists()
    {
        $this->assertTrue(class_exists(ToastrAsset::class));
    }

    public function testToastrAssetExtendsAssetBundle()
    {
        $reflection = new ReflectionClass(ToastrAsset::class);
        $this->assertEquals(AssetBundle::class, $reflection->getParentClass()->getName());
    }

    public function testToastrAssetHasRequiredProperties()
    {
        $reflection = new ReflectionClass(ToastrAsset::class);
        $this->assertTrue($reflection->hasProperty('sourcePath'));
        $this->assertTrue($reflection->hasProperty('css'));
        $this->assertTrue($reflection->hasProperty('js'));
        $this->assertTrue($reflection->hasProperty('depends'));
    }
}
