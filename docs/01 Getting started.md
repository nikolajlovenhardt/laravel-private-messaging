# Getting started

- Add provider
```php
'providers' => [
    LaravelPM\LaravelPMProvider::class,
],
```

- Add facade
```php
'providers' => [
    'PM' => LaravelPM\Facades\Helpers\PMHelperFacade::class,
],
```

- Run `$ php artisan vendor:publish` to publish the configuration file `config/private-messaging.php`