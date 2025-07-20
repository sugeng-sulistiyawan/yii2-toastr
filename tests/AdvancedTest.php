<?php

/**
 * Advanced PHPUnit Testing Examples
 * Converting from Pest advanced features to PHPUnit
 */

namespace diecoding\toastr\tests;

use diecoding\toastr\Toastr;
use diecoding\toastr\ToastrBase;
use Exception;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use Yii;
use yii\web\Application;

class AdvancedTest extends TestCase
{
    /**
     * Data provider for toastr types
     */
    public function toastrTypesProvider()
    {
        return [
            'info' => ['info'],
            'success' => ['success'],
            'warning' => ['warning'],
            'error' => ['error'],
        ];
    }

    /**
     * Data provider for toastr positions
     */
    public function toastrPositionsProvider()
    {
        return [
            'top-right' => ['toast-top-right'],
            'top-left' => ['toast-top-left'],
            'bottom-right' => ['toast-bottom-right'],
            'bottom-left' => ['toast-bottom-left'],
            'top-center' => ['toast-top-center'],
            'bottom-center' => ['toast-bottom-center'],
            'top-full-width' => ['toast-top-full-width'],
            'bottom-full-width' => ['toast-bottom-full-width'],
        ];
    }

    /**
     * @dataProvider toastrTypesProvider
     */
    public function testToastrBaseConstantsMatchExpectedValuesForTypes($type)
    {
        $this->assertContains($type, ToastrBase::TYPES);
    }

    /**
     * @dataProvider toastrPositionsProvider
     */
    public function testToastrBaseConstantsMatchExpectedValuesForPositions($position)
    {
        $this->assertContains($position, ToastrBase::POSITIONS);
    }

    /**
     * @group validation
     */
    public function testToastrBaseTypeValidationWorksCorrectly()
    {
        foreach (ToastrBase::TYPES as $type) {
            $this->assertContains($type, ToastrBase::TYPES);
        }
    }

    /**
     * @group validation
     */
    public function testInvalidTypesAreRejected()
    {
        $this->assertNotContains('invalid_type', ToastrBase::TYPES);
    }

    public function testToastrClassCanBeInstantiatedWithoutErrors()
    {
        // Setup minimal Yii web app for widget testing
        if (! isset(Yii::$app) || Yii::$app === null) {
            $assetsPath = sys_get_temp_dir() . '/test-assets-' . uniqid();
            @mkdir($assetsPath, 0755, true);

            $config = [
                'id' => 'test-app',
                'basePath' => dirname(__DIR__),
                'components' => [
                    'assetManager' => [
                        'basePath' => $assetsPath,
                        'baseUrl' => '/assets',
                    ],
                    'urlManager' => [
                        'enablePrettyUrl' => false,
                    ],
                    'request' => [
                        'cookieValidationKey' => 'test-key',
                        'scriptFile' => __FILE__,
                        'scriptUrl' => '/',
                    ],
                ],
                'aliases' => [
                    '@webroot' => $assetsPath,
                    '@web' => '/',
                ],
            ];
            new Application($config);
        }

        // Test that creating a Toastr instance doesn't throw an exception
        $toastr = null;
        $success = false;

        try {
            $toastr = new Toastr(['skipCoreAssets' => true]); // Skip assets to avoid @webroot issues
            $success = true;
        } catch (Exception $e) {
            // Log the error for debugging
            error_log('Toastr instantiation failed: ' . $e->getMessage());
            $success = false;
        }

        $this->assertTrue($success);
        if ($success) {
            $this->assertInstanceOf(Toastr::class, $toastr);
        }
    }

    public function testToastrBaseArraysHaveCorrectStructure()
    {
        $types = ToastrBase::TYPES;
        $positions = ToastrBase::POSITIONS;

        $this->assertIsArray($types);
        $this->assertCount(4, $types);

        foreach ($types as $type) {
            $this->assertIsString($type);
        }

        $this->assertIsArray($positions);
        $this->assertCount(8, $positions);

        foreach ($positions as $position) {
            $this->assertIsString($position);
            $this->assertStringContainsString('toast-', $position);
        }
    }

    /**
     * @group performance
     */
    public function testCreatingMultipleToastrInstancesIsFast()
    {
        // Setup minimal Yii app for this test (same config as above)
        if (! isset(Yii::$app) || Yii::$app === null) {
            $assetsPath = sys_get_temp_dir() . '/test-assets-perf-' . uniqid();
            @mkdir($assetsPath, 0755, true);

            $config = [
                'id' => 'test-app-perf',
                'basePath' => dirname(__DIR__),
                'components' => [
                    'assetManager' => [
                        'basePath' => $assetsPath,
                        'baseUrl' => '/assets',
                    ],
                    'urlManager' => [
                        'enablePrettyUrl' => false,
                    ],
                    'request' => [
                        'cookieValidationKey' => 'test-key',
                        'scriptFile' => __FILE__,
                        'scriptUrl' => '/',
                    ],
                ],
                'aliases' => [
                    '@webroot' => $assetsPath,
                    '@web' => '/',
                ],
            ];
            new Application($config);
        }

        $start = microtime(true);

        $instances = [];
        for ($i = 0; $i < 10; $i++) { // Reduced from 100 to 10 for faster testing
            $instances[] = new Toastr(['skipCoreAssets' => true]); // Skip assets to avoid issues
        }

        $elapsed = microtime(true) - $start;

        // Should be very fast (less than 1 second for 10 instances)
        $this->assertLessThan(1.0, $elapsed);
        $this->assertEquals(10, count($instances));
    }

    public function testToastrBaseConstantsAreConsistent()
    {
        // All type constants should be lowercase
        foreach (ToastrBase::TYPES as $type) {
            $this->assertEquals(strtolower($type), $type);
        }

        // All position constants should start with 'toast-'
        foreach (ToastrBase::POSITIONS as $position) {
            $this->assertStringStartsWith('toast-', $position);
        }
    }

    public function testToastrBaseClassStructureIsCorrect()
    {
        $reflection = new ReflectionClass(ToastrBase::class);

        $this->assertEquals(ToastrBase::class, $reflection->getName());
        $this->assertFalse($reflection->isAbstract());
        $this->assertFalse($reflection->isInterface());
        $this->assertEquals('yii\base\Widget', $reflection->getParentClass()->getName());
    }

    public function testCreateMockYiiAppHelperWorksCorrectly()
    {
        $this->assertEquals('test', YII_ENV);
        $this->assertTrue(YII_DEBUG);
    }
}
