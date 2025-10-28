# Expense Tracker API

A simple API built with Laravel for tracking income and expenses. This API allows users to register, login, manage categories, and record financial transactions. It is designed to be secure with token-based authentication using Laravel Sanctum.

## Features

- **User Authentication**: Register, login, and logout with token-based authentication.
- **Category Management**: Create, update, delete, and list expense/income categories.
- **Transaction Management**: Create, update, delete, and view transactions related to specific categories.
- **Secure Endpoints**: Protected routes using Laravel Sanctum for API authentication.

## Technologies Used

- **Laravel 8**: PHP framework for building the API.
- **Sanctum**: For API token authentication.
- **MySQL**: Database for storing user data, categories, and transactions.
- **Postman**: For testing API endpoints (optional).

## Installation

Follow these steps to get your development environment set up.

### 1. Clone the Repository
```bash

git clone https://github.com/DuncanTheDev/Expense-tracker-api.git
cd Expense-tracker-api

### 2. Install Dependencies
Make sure you have Composer installed on your machine, then run the following:

composer install

### 3. Configure Environment
Copy .env.example to .env and configure your environment settings (database, app URL, etc.).

cp .env.example .env
git clone https://github.com/DuncanTheDev/Expense-tracker-api.git
cd Expense-tracker-api

### 4. Generate Application Key
Generate the app key required by Laravel:

php artisan key:generate

### 5. Set Up Database
Make sure your database is set up, then run migrations to create the necessary tables:

php artisan migrate

### 6. Set Up API Authentication
To enable API authentication with Sanctum, you need to install Sanctum and set up the middleware.

Run the following:
composer require laravel/sanctum
php artisan migrate
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

Add Sanctum middleware to api middleware group within your app/Http/Kernel.php file:
'api' => [
    \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
    'throttle:api',
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
],

### 7. Start the Development Server
Now, you can start the Laravel development server:

php artisan serve
