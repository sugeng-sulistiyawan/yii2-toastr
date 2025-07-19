<?php

/**
 * ToastrFlash Widget Tests using PHPUnit
 */

namespace diecoding\toastr\tests;

use PHPUnit\Framework\TestCase;
use diecoding\toastr\ToastrFlash;
use diecoding\toastr\ToastrBase;
use ReflectionClass;

class ToastrFlashTest extends TestCase
{
    public function testToastrFlashClassExists()
    {
        $this->assertTrue(class_exists(ToastrFlash::class));
        $this->assertTrue(class_exists(ToastrBase::class));
    }

    public function testToastrFlashExtendsToastrBase()
    {
        $reflection = new ReflectionClass(ToastrFlash::class);
        $this->assertEquals(ToastrBase::class, $reflection->getParentClass()->getName());
    }

    public function testToastrFlashHasRequiredMethods()
    {
        $reflection = new ReflectionClass(ToastrFlash::class);
        $this->assertTrue($reflection->hasMethod('run'));
        $this->assertTrue($reflection->hasMethod('init'));
        $this->assertTrue($reflection->hasMethod('normalizeData'));
        $this->assertTrue($reflection->hasMethod('generateToastr'));
    }

    public function testToastrFlashPrivateMethodsVisibility()
    {
        $reflection = new ReflectionClass(ToastrFlash::class);
        
        $normalizeDataMethod = $reflection->getMethod('normalizeData');
        $this->assertTrue($normalizeDataMethod->isPrivate());
        
        $generateToastrMethod = $reflection->getMethod('generateToastr');
        $this->assertTrue($generateToastrMethod->isPrivate());
    }
}
