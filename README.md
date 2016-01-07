[![Laravel 5.1](https://img.shields.io/badge/Laravel-5.1-orange.svg?style=flat-square)](http://laravel.com) [![Latest Stable Version](https://poser.pugx.org/nikolajlovenhardt/laravel-user-notifications/v/stable)](https://packagist.org/packages/nikolajlovenhardt/laravel-user-notifications) [![Total Downloads](https://poser.pugx.org/nikolajlovenhardt/laravel-user-notifications/downloads)](https://packagist.org/packages/nikolajlovenhardt/laravel-user-notifications) [![Latest Unstable Version](https://poser.pugx.org/nikolajlovenhardt/laravel-user-notifications/v/unstable)](https://packagist.org/packages/nikolajlovenhardt/laravel-user-notifications) [![License](https://poser.pugx.org/nikolajlovenhardt/laravel-user-notifications/license)](https://packagist.org/packages/nikolajlovenhardt/laravel-user-notifications) [![Build Status](https://travis-ci.org/nikolajlovenhardt/laravel-user-notifications.svg?branch=master)](https://travis-ci.org/nikolajlovenhardt/laravel-user-notifications) [![Code Climate](https://codeclimate.com/github/nikolajlovenhardt/laravel-user-notifications/badges/gpa.svg)](https://codeclimate.com/github/nikolajlovenhardt/laravel-user-notifications) [![Test Coverage](https://codeclimate.com/github/nikolajlovenhardt/laravel-user-notifications/badges/coverage.svg)](https://codeclimate.com/github/nikolajlovenhardt/laravel-user-notifications/coverage)

### Setup
- Run `$ composer require nikolajlovenhardt/laravel-user-notifications`

- Add provider
```php
'providers' => [
    LaravelUserNotifications\LaravelUserNotificationsProvider::class,
],
```

- Run `$ php artisan vendor:publish` to publish the configuration file `config/user-notifications.php`