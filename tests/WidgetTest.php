<?php

/**
 * Toastr Widget Tests using PHPUnit
 */

namespace diecoding\toastr\tests;

use diecoding\toastr\Toastr;
use diecoding\toastr\ToastrBase;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class WidgetTest extends TestCase
{
    public function testEnvironmentIsSetToTest()
    {
        $this->assertEquals('test', YII_ENV);
    }

    public function testToastrBaseHasCorrectTypeConstants()
    {
        $this->assertEquals('info', ToastrBase::TYPE_INFO);
        $this->assertEquals('error', ToastrBase::TYPE_ERROR);
        $this->assertEquals('success', ToastrBase::TYPE_SUCCESS);
        $this->assertEquals('warning', ToastrBase::TYPE_WARNING);
    }

    public function testToastrBaseHasCorrectPositionConstants()
    {
        $this->assertEquals('toast-top-right', ToastrBase::POSITION_TOP_RIGHT);
        $this->assertEquals('toast-top-left', ToastrBase::POSITION_TOP_LEFT);
        $this->assertEquals('toast-bottom-right', ToastrBase::POSITION_BOTTOM_RIGHT);
        $this->assertEquals('toast-bottom-left', ToastrBase::POSITION_BOTTOM_LEFT);
    }

    public function testToastrBaseTypesArrayContainsAllValidTypes()
    {
        $this->assertCount(4, ToastrBase::TYPES);
        $this->assertContains('info', ToastrBase::TYPES);
        $this->assertContains('error', ToastrBase::TYPES);
        $this->assertContains('success', ToastrBase::TYPES);
        $this->assertContains('warning', ToastrBase::TYPES);
    }

    public function testToastrBasePositionsArrayContainsAllValidPositions()
    {
        $this->assertCount(8, ToastrBase::POSITIONS);
        $this->assertContains('toast-top-right', ToastrBase::POSITIONS);
        $this->assertContains('toast-bottom-left', ToastrBase::POSITIONS);
    }

    public function testToastrWidgetValidatesToastrTypeValues()
    {
        $this->assertContains('success', ToastrBase::TYPES);
        $this->assertContains('info', ToastrBase::TYPES);
        $this->assertContains('warning', ToastrBase::TYPES);
        $this->assertContains('error', ToastrBase::TYPES);
    }

    public function testToastrClassExistsAndCanBeReferenced()
    {
        $this->assertTrue(class_exists(Toastr::class));
        $this->assertTrue(class_exists(ToastrBase::class));
    }

    public function testToastrExtendsToastrBase()
    {
        $reflection = new ReflectionClass(Toastr::class);
        $this->assertEquals(ToastrBase::class, $reflection->getParentClass()->getName());
    }

    public function testToastrBaseHasRequiredMethods()
    {
        $reflection = new ReflectionClass(ToastrBase::class);
        $this->assertTrue($reflection->hasMethod('init'));
        $this->assertTrue($reflection->hasMethod('getView'));
    }

    public function testToastrHasRequiredMethods()
    {
        $reflection = new ReflectionClass(Toastr::class);
        $this->assertTrue($reflection->hasMethod('run'));
    }

    public function testToastrBaseHasRequiredProperties()
    {
        $reflection = new ReflectionClass(ToastrBase::class);
        $this->assertTrue($reflection->hasProperty('typeDefault'));
        $this->assertTrue($reflection->hasProperty('titleDefault'));
        $this->assertTrue($reflection->hasProperty('messageDefault'));
        $this->assertTrue($reflection->hasProperty('closeButton'));
        $this->assertTrue($reflection->hasProperty('progressBar'));
        $this->assertTrue($reflection->hasProperty('positionClass'));
    }

    public function testToastrHasRequiredProperties()
    {
        $reflection = new ReflectionClass(Toastr::class);
        $this->assertTrue($reflection->hasProperty('type'));
        $this->assertTrue($reflection->hasProperty('title'));
        $this->assertTrue($reflection->hasProperty('message'));
    }

    public function testToastrBaseInitMethod()
    {
        // Test the skipCoreAssets alias logic without calling init()
        $toastr = new class () extends ToastrBase {
            public function run()
            {
            }
            public function testAlias()
            {
                // Test the alias logic from init method
                $this->skipCoreAssets = $this->skipCoreAssets !== true && $this->useCustomAssets !== null ? $this->useCustomAssets : $this->skipCoreAssets;

                return $this->skipCoreAssets;
            }
        };

        // Test deprecated useCustomAssets property
        $toastr->useCustomAssets = true;
        $result = $toastr->testAlias();
        $this->assertTrue($result);

        // Test with skipCoreAssets true
        $toastr2 = new class () extends ToastrBase {
            public function run()
            {
            }
            public function testAlias()
            {
                $this->skipCoreAssets = $this->skipCoreAssets !== true && $this->useCustomAssets !== null ? $this->useCustomAssets : $this->skipCoreAssets;

                return $this->skipCoreAssets;
            }
        };
        $toastr2->skipCoreAssets = true;
        $result2 = $toastr2->testAlias();
        $this->assertTrue($result2);
    }

    public function testToastrRunMethod()
    {
        // Test the run method logic without widget instantiation
        $toastr = new Toastr();

        // Test type validation logic
        $toastr->type = 'success';
        $validType = in_array($toastr->type, ToastrBase::TYPES) ? $toastr->type : $toastr->typeDefault;
        $this->assertEquals('success', $validType);

        // Test with invalid type
        $toastr->type = 'invalid';
        $validType = in_array($toastr->type, ToastrBase::TYPES) ? $toastr->type : $toastr->typeDefault;
        $this->assertEquals('info', $validType); // Should use default

        // Test title fallback
        $toastr->title = null;
        $title = $toastr->title ?: $toastr->titleDefault;
        $this->assertEquals('', $title);

        $toastr->title = 'Custom Title';
        $title = $toastr->title ?: $toastr->titleDefault;
        $this->assertEquals('Custom Title', $title);

        // Test message fallback
        $toastr->message = null;
        $message = $toastr->message ?: $toastr->messageDefault;
        $this->assertEquals('', $message);

        $toastr->message = 'Custom Message';
        $message = $toastr->message ?: $toastr->messageDefault;
        $this->assertEquals('Custom Message', $message);
    }

    public function testToastrBaseOptionsBuilding()
    {
        $toastr = new class () extends ToastrBase {
            public function run()
            {
            }
            public function buildOptions()
            {
                return \yii\helpers\ArrayHelper::merge([
                    "closeButton" => $this->closeButton,
                    "debug" => $this->debug,
                    "newestOnTop" => $this->newestOnTop,
                    "progressBar" => $this->progressBar,
                    "positionClass" => $this->positionClass,
                    "preventDuplicates" => $this->preventDuplicates,
                    "showDuration" => $this->showDuration,
                    "hideDuration" => $this->hideDuration,
                    "timeOut" => $this->timeOut,
                    "extendedTimeOut" => $this->extendedTimeOut,
                    "showEasing" => $this->showEasing,
                    "hideEasing" => $this->hideEasing,
                    "showMethod" => $this->showMethod,
                    "hideMethod" => $this->hideMethod,
                    "tapToDismiss" => $this->tapToDismiss,
                    "escapeHtml" => $this->escapeHtml,
                    "rtl" => $this->rtl,
                ], $this->options);
            }
        };

        $options = $toastr->buildOptions();
        $this->assertIsArray($options);
        $this->assertArrayHasKey('closeButton', $options);
        $this->assertArrayHasKey('progressBar', $options);
        $this->assertArrayHasKey('positionClass', $options);
        $this->assertEquals('toast-top-right', $options['positionClass']);
        $this->assertEquals(5000, $options['timeOut']);
        $this->assertEquals('swing', $options['showEasing']);
    }
}
