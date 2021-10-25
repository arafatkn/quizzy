## Quizzy - Online Quiz System

<p align="center">
    <img src="https://github.styleci.io/repos/414869056/shield?style=flat" alt="StyleCI" />
</p>

***
Current Version: v0.0.4

### Technologies used so far...
- Laravel 8 as backend framework.
- PHPUnit for Testing.
- Bootstrap 5 for Frontend.
- VueJS and Axios in Quiz Attempt Page.

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

