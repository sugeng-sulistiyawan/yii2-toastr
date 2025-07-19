<?php

/**
 * Toastr Widget Tests using PHPUnit
 */

namespace diecoding\toastr\tests;

use PHPUnit\Framework\TestCase;
use diecoding\toastr\Toastr;
use diecoding\toastr\ToastrBase;
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
}
