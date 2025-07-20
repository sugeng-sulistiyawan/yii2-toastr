<?php

/**
 * ToastrAsset Tests using PHPUnit
 */

namespace diecoding\toastr\tests;

use ReflectionClass;
use yii\web\YiiAsset;
use yii\web\AssetBundle;
use PHPUnit\Framework\TestCase;
use diecoding\toastr\ToastrAsset;

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

    public function testAssetPropertiesValues()
    {
        $asset = new ToastrAsset();

        // Test that sourcePath is set correctly (might be resolved to absolute path)
        $this->assertStringContainsString('toastr/build', $asset->sourcePath);

        // Test CSS files
        $this->assertIsArray($asset->css);
        $this->assertContains('toastr.min.css', $asset->css);
        $this->assertCount(1, $asset->css);

        // Test JS files
        $this->assertIsArray($asset->js);
        $this->assertContains('toastr.min.js', $asset->js);
        $this->assertCount(1, $asset->js);

        // Test dependencies
        $this->assertIsArray($asset->depends);
        $this->assertContains(YiiAsset::class, $asset->depends);
        $this->assertCount(1, $asset->depends);
    }

    public function testAssetInheritance()
    {
        $this->assertTrue(is_subclass_of(ToastrAsset::class, AssetBundle::class));
    }

    public function testAssetInstantiation()
    {
        $asset = new ToastrAsset();

        // Test that the object is created successfully
        $this->assertInstanceOf(ToastrAsset::class, $asset);
        $this->assertInstanceOf(AssetBundle::class, $asset);

        // Test that all properties are accessible
        $sourcePath = $asset->sourcePath;
        $css = $asset->css;
        $js = $asset->js;
        $depends = $asset->depends;

        $this->assertNotNull($sourcePath);
        $this->assertNotNull($css);
        $this->assertNotNull($js);
        $this->assertNotNull($depends);
    }

    public function testAssetPropertyTypes()
    {
        $asset = new ToastrAsset();

        // Verify property types
        $this->assertIsString($asset->sourcePath);
        $this->assertIsArray($asset->css);
        $this->assertIsArray($asset->js);
        $this->assertIsArray($asset->depends);

        // Verify array contents are strings
        foreach ($asset->css as $cssFile) {
            $this->assertIsString($cssFile);
        }

        foreach ($asset->js as $jsFile) {
            $this->assertIsString($jsFile);
        }

        foreach ($asset->depends as $dependency) {
            $this->assertIsString($dependency);
        }
    }

    public function testAssetFileExtensions()
    {
        $asset = new ToastrAsset();

        // Test CSS file has correct extension
        foreach ($asset->css as $cssFile) {
            $this->assertStringEndsWith('.css', $cssFile);
        }

        // Test JS file has correct extension
        foreach ($asset->js as $jsFile) {
            $this->assertStringEndsWith('.js', $jsFile);
        }
    }
}
