[![Laravel 5.1](https://img.shields.io/badge/Laravel-5.1-orange.svg?style=flat-square)](http://laravel.com) [![Latest Stable Version](https://poser.pugx.org/nikolajlovenhardt/laravel-private-messaging/v/stable)](https://packagist.org/packages/nikolajlovenhardt/laravel-private-messaging) [![Total Downloads](https://poser.pugx.org/nikolajlovenhardt/laravel-private-messaging/downloads)](https://packagist.org/packages/nikolajlovenhardt/laravel-private-messaging) [![Latest Unstable Version](https://poser.pugx.org/nikolajlovenhardt/laravel-private-messaging/v/unstable)](https://packagist.org/packages/nikolajlovenhardt/laravel-private-messaging) [![License](https://poser.pugx.org/nikolajlovenhardt/laravel-private-messaging/license)](https://packagist.org/packages/nikolajlovenhardt/laravel-private-messaging) [![Build Status](https://travis-ci.org/nikolajlovenhardt/laravel-private-messaging.svg?branch=master)](https://travis-ci.org/nikolajlovenhardt/laravel-private-messaging) [![Code Climate](https://codeclimate.com/github/nikolajlovenhardt/laravel-private-messaging/badges/gpa.svg)](https://codeclimate.com/github/nikolajlovenhardt/laravel-private-messaging) [![Test Coverage](https://codeclimate.com/github/nikolajlovenhardt/laravel-private-messaging/badges/coverage.svg)](https://codeclimate.com/github/nikolajlovenhardt/laravel-private-messaging/coverage)

### Setup
- Run `$ composer require nikolajlovenhardt/laravel-private-messaging`

- Add provider
```php
'providers' => [
    LaravelPM\LaravelPMProvider::class,
],
```

- Run `$ php artisan vendor:publish` to publish the configuration file `config/private-messaging.php`