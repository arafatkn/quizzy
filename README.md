## Quizzy - Online Quiz System

<p align="center">
    <img src="https://github.styleci.io/repos/414869056/shield?style=flat" alt="StyleCI" />
</p>

***
### Technologies used so far...
- Laravel 8 as backend framework.
- PHPUnit for Testing.
- Bootstrap 5 for Frontend.

### Live Demo
**[Live Demo Link](https://quizzy.arafatkn.com)**

### Requirements
- PHP 7.3 minimum
- Composer
- MySQL or MariaDB
- NodeJS
  - If you want to update the style or javascript, you need to recompile.

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

