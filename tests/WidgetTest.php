<?php

/**
 * Toastr Widget Tests using Pest
 */

use diecoding\toastr\Toastr;
use diecoding\toastr\ToastrBase;

test('environment is set to test', function () {
    expect(YII_ENV)->toBe('test');
});

test('ToastrBase has correct type constants', function () {
    expect(ToastrBase::TYPE_INFO)->toBe('info');
    expect(ToastrBase::TYPE_ERROR)->toBe('error');
    expect(ToastrBase::TYPE_SUCCESS)->toBe('success');
    expect(ToastrBase::TYPE_WARNING)->toBe('warning');
});

test('ToastrBase has correct position constants', function () {
    expect(ToastrBase::POSITION_TOP_RIGHT)->toBe('toast-top-right');
    expect(ToastrBase::POSITION_TOP_LEFT)->toBe('toast-top-left');
    expect(ToastrBase::POSITION_BOTTOM_RIGHT)->toBe('toast-bottom-right');
    expect(ToastrBase::POSITION_BOTTOM_LEFT)->toBe('toast-bottom-left');
});

test('ToastrBase types array contains all valid types', function () {
    expect(ToastrBase::TYPES)->toHaveCount(4);
    expect(ToastrBase::TYPES)->toContain('info');
    expect(ToastrBase::TYPES)->toContain('error');
    expect(ToastrBase::TYPES)->toContain('success');
    expect(ToastrBase::TYPES)->toContain('warning');
});

test('ToastrBase positions array contains all valid positions', function () {
    expect(ToastrBase::POSITIONS)->toHaveCount(8);
    expect(ToastrBase::POSITIONS)->toContain('toast-top-right');
    expect(ToastrBase::POSITIONS)->toContain('toast-bottom-left');
});

test('Toastr widget validates toastr type values', function () {
    expect('success')->toBeValidToastrType();
    expect('info')->toBeValidToastrType();
    expect('warning')->toBeValidToastrType();
    expect('error')->toBeValidToastrType();
});

test('Toastr class exists and can be referenced', function () {
    expect(class_exists(Toastr::class))->toBeTrue();
    expect(class_exists(ToastrBase::class))->toBeTrue();
});

test('Toastr extends ToastrBase', function () {
    $reflection = new ReflectionClass(Toastr::class);
    expect($reflection->getParentClass()->getName())->toBe(ToastrBase::class);
});

test('ToastrBase has required methods', function () {
    $reflection = new ReflectionClass(ToastrBase::class);
    expect($reflection->hasMethod('init'))->toBeTrue();
    expect($reflection->hasMethod('getView'))->toBeTrue();
});

test('Toastr has required methods', function () {
    $reflection = new ReflectionClass(Toastr::class);
    expect($reflection->hasMethod('run'))->toBeTrue();
});

test('ToastrBase has required properties', function () {
    $reflection = new ReflectionClass(ToastrBase::class);
    expect($reflection->hasProperty('typeDefault'))->toBeTrue();
    expect($reflection->hasProperty('titleDefault'))->toBeTrue();
    expect($reflection->hasProperty('messageDefault'))->toBeTrue();
    expect($reflection->hasProperty('closeButton'))->toBeTrue();
    expect($reflection->hasProperty('progressBar'))->toBeTrue();
    expect($reflection->hasProperty('positionClass'))->toBeTrue();
});

test('Toastr has required properties', function () {
    $reflection = new ReflectionClass(Toastr::class);
    expect($reflection->hasProperty('type'))->toBeTrue();
    expect($reflection->hasProperty('title'))->toBeTrue();
    expect($reflection->hasProperty('message'))->toBeTrue();
});
