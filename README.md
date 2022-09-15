<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a><a href="https://spatie.be/"><img src="https://avatars.githubusercontent.com/u/7535935?s=192" height="100"/></a></p>

# About Laravel RBAC

Laravel is a web application framework with expressive, elegant syntax based on the PHP language while spatie is a package that allows you to manage user permissions and roles in a database. Laravel creators believe development must be an enjoyable and creative experience to be truly fulfilling. Likewise this project takes the pain out of development by easing common tasks used in many web projects.

## System Requirements

```
PHP* Version >=7.4.0 && <= 8.1.6
composer
MySQL or MariaDB

*Tested with PHP 8.1.6 and MariaDB from (XAMPP windows 64bit 8.1.6.0-VS16), composer v2.3.5
```

## Running the package

```
git clone https://github.com/nzivo/laravel-RBAC.git
composer install
```

You should publish the **migration** and the **config/permission.php** config file with:

```
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

Clear your config cache

```
php artisan optimize:clear
 # or
php artisan config:clear
```

Run the migrations

```
php artisan migrate
 # or seed the database with dummy data
php artisan migrate:fresh --seed
```

# Dingo

The [Dingo API](https://github.com/dingo/api/wiki/Configuration) package is meant to provide you, the developer, with a set of tools to help you easily and quickly build your own API

## Publish the config

Publishing Dingo configuration you can run the following artisan command:

```
php artisan vendor:publish --provider="Dingo\Api\Provider\LaravelServiceProvider"
```

In your `.env` file you need to change the value of:

```
API_DEBUG=true
```

true will give you a detail of each error you get in response **advised for development purpose** in production, replace with **false**

# JWT-AUTH

JSON Web Token Authentication ([jwt-auth](https://jwt-auth.readthedocs.io/en/docs/)) for Laravel & Lumen

## Publish the config

publish the package config file:

```
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
```

You should now have a `config/jwt.php` file that allows you to configure the basics of this package.

## Generate secret key

The command below should add a secret jwt key for you in the `.env` file

```
php artisan jwt:secret
```

🤓 Happy coding ...

## Security Vulnerabilities

If you discover a security vulnerability within this project, please send an e-mail to John Nzivo via [johnnzivo56@gmail.com](mailto:johnnzivo56@gmail.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel RBAC is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
