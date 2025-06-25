# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/sujan-sht/admin-master.svg?style=flat-square)](https://packagist.org/packages/sujan-sht/admin-master)
[![Total Downloads](https://img.shields.io/packagist/dt/sujan-sht/admin-master.svg?style=flat-square)](https://packagist.org/packages/sujan-sht/admin-master)
![GitHub Actions](https://github.com/sujan-sht/admin-master/actions/workflows/main.yml/badge.svg)


## Installation

You can install the package via composer:

```bash
composer require sujan-sht/admin-master
```

## Usage
To use the admin panel, you must publish the required assets and configuration files. Run the following commands:
```php
php artisan vendor:publish --tag=admin-master-config
php artisan vendor:publish --tag=media-library-modules
php artisan vendor:publish --provider="Rappasoft\LaravelLivewireTables\LaravelLivewireTablesServiceProvider" --tag=livewire-tables-config
php artisan vendor:publish --tag=admin-master-seeders
```
These will publish:

- Public assets (CSS, JS)

- Configuration file (config/admin-master.php)

- Media library module scaffolding (app/Modules)


After publishing, In config/livewire-tables.php file
```php
'theme' => 'bootstrap-4',
```
Add AdminMasterUser Trait in Your User Model
```php
use SujanSht\AdminMaster\Traits\AdminMasterUser;

class User extends Authenticatable
{
    use AdminMasterUser;
}
```
To migrate tables
```php
php artisan migrate
```

Seed the database to create superadmin,dummy roles and permissions 
```php
php artisan db:seed RoleSeeder
php artisan db:seed UserSeeder
php artisan db:seed PermissionSeeder

```
You can now login superadmin user using this credentials
```php
email: admin@admin.com
password: admin123
```
In config/app.php add this line.
```php
'providers' => ServiceProvider::defaultProviders()->merge([
        ......
        App\Providers\AdminServiceProvider::class
    ])->toArray(),
```
In routes/web.php add this line
```php
Route::admin();
```
You can simply generate CRUD using command/by creating menu from admin panel that will generate all the files in repository pattern.
```php
php artisan make:crud Test
```

Install Media Library

Include Package Path In composer.json .
```php
    "repositories": {
        "spatie/laravel-medialibrary-pro": {
            "type": "path",
            "url": "app/Modules",
            "options": {
                "symlink": true
            }
        }
    }
```
After adding it in composer.json, run the command
```php
composer require spatie/laravel-medialibrary-pro:dev-main
```
## Optional
To customize configuration, views, migrations, and seeders, you may also publish:
```php
php artisan vendor:publish --tag=admin-master-assets
php artisan vendor:publish --tag=admin-master-views
php artisan vendor:publish --tag=admin-master-migrations

```
These allow you to:

- Override package blade views

- Modify database migrations and seeders as needed

<!-- 
### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently. -->

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email sujanstha016@gmail.com instead of using the issue tracker.

## Credits

-   [Sujan Shrestha](https://github.com/sujan-sht)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
