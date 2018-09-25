# Yii2 Toastr - Simple flash toastr notifications for Yii2



## Cara Memasang

* Melalui console

```
composer require --prefer-dist diecoding/yii2-toastr "*"
```

* Melalui `composer.json`

1. Tambahkan pada baris `require`

```
"diecoding/yii2-toastr": "*"
```

2. Kemudian jalankan

```
composer update
```


## Cara Menggunakan

1. Tambahkan di `views\layouts\main.php`

```php
\diecoding\toastr\ToastrFlash::widget();

// custom
\diecoding\toastr\ToastrFlash::widget([
    "hideDuration"      => 'custom value',
    "timeOut"           => 'custom value',
    "extendedTimeOut"   => 'custom value',
    "showEasing"        => 'custom value',
    "hideEasing"        => 'custom value',
    "showMethod"        => 'custom value',
    "hideMethod"        => 'custom value',
    "tapToDismiss"      => 'custom value',
]);

// or
\diecoding\toastr\ToastrFlash::widget([
    'options' => [
        "closeButton"       => 'custom value',
        "debug"             => 'custom value',
        "newestOnTop"       => 'custom value',
        "progressBar"       => 'custom value',
        "positionClass"     => 'custom value',
        "preventDuplicates" => 'custom value',
    ],
]);
```

2. Set Session Flash
  * Cara Basic

```php
\Yii::$app->session->setFlash('error', 'Message');

\Yii::$app->session->setFlash('error', ['Message 1', 'Message 2', 'Message 3']);
```

  * Cara Advanced

```php
\Yii::$app->session->setFlash('error', [['Title', 'Message']]);

\Yii::$app->session->setFlash('error', [['Title 1', 'Message 1'], ['Title 2', 'Message 2'], ['Title 3', 'Message 3']]);
```
