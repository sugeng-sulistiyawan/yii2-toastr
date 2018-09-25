# Yii2 Toastr - Simple flash toastr notifications for Yii2
#### BETA VERSION


## Cara Memasang

Melalui console:

```
composer require --prefer-dist diecoding/yii2-toastr "dev-master"
```

atau tambahkan:

```
"diecoding/yii2-toastr": "dev-master"
```

pada baris `require` yang terdapat di berkas `composer.json`. Kemudian jalankan

```
composer update
```


## Cara Menggunakan

1. Tambahkan di `views\layouts\main.php`

```php
\diecoding\toastr\ToastrFlash::widget();
```

2. Set Session Flash
  * Cara Basic

```php
\Yii::$app->session->setFlash('error', 'Message');
```

  * Cara Advanced

```php
\Yii::$app->session->setFlash('error', ['title' => 'Title', 'message' => 'Message']);
```
