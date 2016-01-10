# Getting started

## Usage

Laravel User Notifications makes it easy to integrate user notifications in your Laravel 5+ application.
User notifications can for example be new posts, likes or whenever something relevant for the user happens.
If you have any questions feel free to open an issue.

## Installation

*Composer*

Run `$ composer require nikolajlovenhardt/laravel-user-notifications` to install the package.

## Provider

Àdd the provider to `config/app.php`

```php
'providers' => [
    LaravelUserNotifications\LaravelUserNotificationsProvider::class,
],
```

## Configuration

Publish the configuration

Run `$ php artisan vendor:publish --provider="LaravelUserNotifications\LaravelUserNotificationsProvider" --tag="config"`

## Mapper

This step goes through the setup with Eloquent and LaravelDoctrine.

Setup with:

- (Eloquent)[02 Eloquent.md]
- (LaravelDoctrine)[02 Doctirne.md]