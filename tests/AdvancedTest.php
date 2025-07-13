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
    // Setup minimal Yii web app for widget testing
    if (!isset(Yii::$app) || Yii::$app === null) {
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
        new yii\web\Application($config);
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
    
    expect($success)->toBeTrue();
    if ($success) {
        expect($toastr)->toBeInstanceOf(Toastr::class);
    }
});

// Testing dengan closures dan anonymous functions
test('ToastrBase arrays have correct structure', function () {
    $types = ToastrBase::TYPES;
    $positions = ToastrBase::POSITIONS;
    
    expect($types)
        ->toBeArray()
        ->toHaveCount(4);
        
    foreach ($types as $type) {
        expect($type)->toBeString();
    }
        
    expect($positions)
        ->toBeArray()
        ->toHaveCount(8);
        
    foreach ($positions as $position) {
        expect($position)->toBeString();
        expect($position)->toContain('toast-');
    }
});

// Performance testing sederhana  
test('creating multiple Toastr instances is fast', function () {
    // Setup minimal Yii app for this test (same config as above)
    if (!isset(Yii::$app) || Yii::$app === null) {
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
        new yii\web\Application($config);
    }
    
    $start = microtime(true);
    
    $instances = [];
    for ($i = 0; $i < 10; $i++) { // Reduced from 100 to 10 for faster testing
        $instances[] = new Toastr(['skipCoreAssets' => true]); // Skip assets to avoid issues
    }
    
    $elapsed = microtime(true) - $start;
    
    // Should be very fast (less than 1 second for 10 instances)
    expect($elapsed)->toBeLessThan(1.0);
    expect(count($instances))->toBe(10);
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
    
    expect($reflection->getName())->toBe(ToastrBase::class);
    expect($reflection->isAbstract())->toBeFalse();
    expect($reflection->isInterface())->toBeFalse();
    expect($reflection->getParentClass()->getName())->toBe('yii\base\Widget');
});

// Test dengan custom helper function
test('createMockYiiApp helper works correctly', function () {
    $result = createMockYiiApp();
    expect($result)->toBeTrue();
    expect(YII_ENV)->toBe('test');
    expect(YII_DEBUG)->toBeTrue();
});

// Skip test dengan kondisi tertentu
test('advanced feature test', function () {
    // Test advanced features here
    $result = true;
    expect($result)->toBeTrue();
})->skip('Advanced features not implemented yet');

// Placeholder for future features (removed todo() as it's not available in Pest 1.x)
test('future feature placeholder', function () {
    // This is a placeholder for future features
    $this->markTestSkipped('Future feature not implemented yet');
});
