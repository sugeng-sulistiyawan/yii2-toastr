<?php

/**
 * Advanced Pest Testing Examples
 * Menunjukkan fitur-fitur advanced dari Pest
 */

use diecoding\toastr\ToastrBase;
use diecoding\toastr\Toastr;

// Dataset testing - test dengan multiple data
dataset('toastr_types', [
    'info' => ['info'],
    'success' => ['success'], 
    'warning' => ['warning'],
    'error' => ['error'],
]);

dataset('toastr_positions', [
    'top-right' => ['toast-top-right'],
    'top-left' => ['toast-top-left'],
    'bottom-right' => ['toast-bottom-right'],
    'bottom-left' => ['toast-bottom-left'],
    'top-center' => ['toast-top-center'],
    'bottom-center' => ['toast-bottom-center'],
    'top-full-width' => ['toast-top-full-width'],
    'bottom-full-width' => ['toast-bottom-full-width'],
]);

// Parameterized test dengan dataset
test('ToastrBase constants match expected values for types', function ($type) {
    expect($type)->toBeIn(ToastrBase::TYPES);
})->with('toastr_types');

test('ToastrBase constants match expected values for positions', function ($position) {
    expect($position)->toBeIn(ToastrBase::POSITIONS);
})->with('toastr_positions');

// Grouped tests dengan describe-like syntax menggunakan tags
test('ToastrBase type validation works correctly', function () {
    foreach (ToastrBase::TYPES as $type) {
        expect($type)->toBeValidToastrType();
    }
})->group('validation');

test('invalid types are rejected by custom expectation', function () {
    expect('invalid_type')->not->toBeValidToastrType();
})->group('validation');

// Testing dengan exception expectations
test('Toastr class can be instantiated without errors', function () {
    expect(fn() => new Toastr())->not->toThrow();
});

// Testing dengan closures dan anonymous functions
test('ToastrBase arrays have correct structure', function () {
    expect(ToastrBase::TYPES)
        ->toBeArray()
        ->toHaveCount(4)
        ->each->toBeString();
        
    expect(ToastrBase::POSITIONS)
        ->toBeArray()
        ->toHaveCount(8)
        ->each->toBeString()
        ->each->toContain('toast-');
});

// Performance testing sederhana
test('creating multiple Toastr instances is fast', function () {
    $start = microtime(true);
    
    for ($i = 0; $i < 100; $i++) {
        new Toastr();
    }
    
    $elapsed = microtime(true) - $start;
    
    // Should be very fast (less than 1 second for 100 instances)
    expect($elapsed)->toBeLessThan(1.0);
})->group('performance');

// Test dengan conditional logic
test('ToastrBase constants are consistent', function () {
    // All type constants should be lowercase
    foreach (ToastrBase::TYPES as $type) {
        expect($type)->toBe(strtolower($type));
    }
    
    // All position constants should start with 'toast-'
    foreach (ToastrBase::POSITIONS as $position) {
        expect($position)->toStartWith('toast-');
    }
});

// Test dengan multiple assertions chains
test('ToastrBase class structure is correct', function () {
    $reflection = new ReflectionClass(ToastrBase::class);
    
    expect($reflection)
        ->getName()->toBe(ToastrBase::class)
        ->isAbstract()->toBeFalse()
        ->isInterface()->toBeFalse()
        ->getParentClass()->getName()->toBe('yii\base\Widget');
});

// Test dengan custom helper function
test('createMockYiiApp helper works correctly', function () {
    expect(createMockYiiApp())->toBeTrue();
    expect(YII_ENV)->toBe('test');
    expect(YII_DEBUG)->toBeTrue();
});

// Skip test dengan kondisi tertentu
test('advanced feature test', function () {
    // Test advanced features here
    expect(true)->toBeTrue();
})->skip('Advanced features not implemented yet');

// Todo test untuk fitur masa depan
test('future feature placeholder')->todo();
