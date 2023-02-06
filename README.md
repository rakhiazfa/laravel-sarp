# Laravel Sarp

### Installation

- Require the Laravel Sarp with composer.

```
composer require rakhiazfa/laravel-sarp
```

- Publish package configuration ( important ).

```
php artisan vendor:publish --provider="Rakhiazfa\LaravelSarp\Providers\SarpServiceProvider" --tag="config"
```

### Usage

- Create a new repository.

```
php artisan make:repository UserRepository
```


- Create a new service.

```
php artisan make:service UserService
```

### License

The MIT License (MIT). Please see [License File](LICENSE.md) for more info
