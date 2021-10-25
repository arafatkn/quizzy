## Quizzy - Online Quiz System


![StyleCI Status](https://github.styleci.io/repos/414869056/shield?style=flat "StyleCI")
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/arafatkn/quizzy/badges/quality-score.png)](https://scrutinizer-ci.com/g/arafatkn/quizzy/)
[![Build Status](https://scrutinizer-ci.com/g/arafatkn/quizzy/badges/build.png)](https://scrutinizer-ci.com/g/arafatkn/quizzy/build-status/)

***
Current Version: v0.1.1

### Technologies used so far...
#### Frameworks, Libraries, Packages etc...
- [Laravel 8](https://laravel.com) as backend framework.
- MySQL as database.
- Redis for cache & queue.
- [PHPUnit](https://phpunit.de/) for Testing.
- [Bootstrap 5](https://getbootstrap.com/docs/5.0/getting-started/introduction/) for Frontend.
- [VueJS](https://vuejs.org/) and [Axios](https://axios-http.com/) in Quiz Attempt Page.
- [Laravel Horizon](https://laravel.com/docs/master/horizon)
- [Laravel Debugbar](https://github.com/barryvdh/laravel-debugbar)
- [Laravel Valet](https://laravel.com/docs/master/valet) for local development.
- [Laravel Settings](https://packagist.org/packages/arafatkn/laravel-settings) by Me
- [Predis](https://github.com/predis/predis) for redis connection.
- [Sentry](https://sentry.io/) for error tracking.
- [Faker](https://fakerphp.github.io/) for generating fake data in testing.

### Followed Standards
* PSR-4 Autoloading Standard.
* PSR-2 Coding Standard.

### Live Demo
**[Live Demo Link](https://quizzy.arafatkn.com)**

### Requirements
- PHP 7.3 minimum
- Composer
- MySQL or MariaDB
- NodeJS
  - If you want to update the style or javascript, you need to recompile.
- PCNTL PHP Extension.

### Installation Process

#### Copy .env.example to .env

```bash
php -r "file_exists('.env') || copy('.env.example', '.env');"
```

#### Key Generate

```bash
php artisan key:generate
```

#### Update Environment Values
Edit `.env` file and update the values related to mysql config and site settings.

#### Install composer packages

```bash
composer install
```

#### Install Node Packages 
(skip this step if you do not want to update style and javascript)

```bash
npm install
```

#### Migrate Database

```bash
php artisan migrate
```

#### Install settings and admin details (Coming Soon)

```bash
php artisan site:install
```

Follow the steps shown in your terminal and complete the installation process.

#### Setup Author Digest
You can send digest email to authors manually by running below command.

```bash
php artisan send:author-digest
```

However, the author digest has been scheduled to be run in 10 AM every day. You need to run the scheduler using crontab.

```bash
php artisan schedule:run
```

The digest will be processed in background. You need to run `Horizon` in background for the best service. However, you can switch to database or simple redis based queue processing also.

```bash
php artisan horizon
```

Alternatively, for simple `redis` or `database` based queue processing, run-

```bash
php artisan queue:work
```

For switching to `database` based queue system, you need to update below ENV variables-

```dotenv
QUEUE_CONNECTION=database
```

For switching from queue system to instant processing, you need to update below ENV variables-

```dotenv
QUEUE_CONNECTION=sync
```

