<?php

/**
 * ToastrFlash Widget Tests using Pest
 */

use diecoding\toastr\ToastrFlash;
use diecoding\toastr\ToastrBase;

test('ToastrFlash class exists', function () {
    expect(class_exists(ToastrFlash::class))->toBeTrue();
    expect(class_exists(ToastrBase::class))->toBeTrue();
});

test('ToastrFlash extends ToastrBase', function () {
    $reflection = new ReflectionClass(ToastrFlash::class);
    expect($reflection->getParentClass()->getName())->toBe(ToastrBase::class);
});

test('ToastrFlash has required methods', function () {
    $reflection = new ReflectionClass(ToastrFlash::class);
    expect($reflection->hasMethod('run'))->toBeTrue();
    expect($reflection->hasMethod('init'))->toBeTrue();
    expect($reflection->hasMethod('normalizeData'))->toBeTrue();
    expect($reflection->hasMethod('generateToastr'))->toBeTrue();
});

test('ToastrFlash private methods visibility', function () {
    $reflection = new ReflectionClass(ToastrFlash::class);
    
    $normalizeDataMethod = $reflection->getMethod('normalizeData');
    expect($normalizeDataMethod->isPrivate())->toBeTrue();
    
    $generateToastrMethod = $reflection->getMethod('generateToastr');
    expect($generateToastrMethod->isPrivate())->toBeTrue();
});
