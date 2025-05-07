## ✨ Laravel Point of Sale

[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE.md)
[![Laravel Version](https://img.shields.io/badge/Laravel-^12.0-red.svg)](https://laravel.com/) [![PHP Version](https://img.shields.io/badge/PHP-^8.2-blue.svg)](https://www.php.net/)

A simple and powerful Point of Sale (POS) management system , built with **Laravel 12 Livewire Staterkit** and **SQLite**.

## Feature

-   **Point of Sale (POS)**
-   **Transaction Management**
-   **Stock Management**
-   **Product Management**

## 🚀 How to Use

### 1. Clone the Repository

To get started, clone or download the repository:

```bash
git clone https://github.com/Luthfiahmad12/POS-APP.git
```

### 2. Set Up the Project

Once you’ve cloned the repository, navigate to the project directory and install dependencies:

```bash
cd POS-APP
composer install
```

### 3. Setup Config file

Rename or copy `.env.example` file to `.env` 1.`php artisan key:generate` to generate app key.

-   Set your database credentials in your `.env` file
-   Set your `APP_URL` in your `.env` file.

### Setup Database

-   Migrate database table `php artisan migrate:fresh`
-   `php artisan db:seed`, this will generate product dummy data and create admin user for you [email: admin@mail.com - password: password]

### Install Node Dependencies

-   `npm install` to install node dependencies
-   `npm run dev` for development or `npm run build` for production

### Running Server

-   `php artisan serve` to run the application locally

## 💡 Contributing

Have suggestions or want to contribute? Here’s how:

-   Submit a **Pull Request (PR)**
-   Report issues or request features by creating an **Issue**

---

> Connect with me on [GitHub](https://github.com/luthfiahmad12) &nbsp;&middot;&nbsp; [LinkedIn](https://www.linkedin.com/in/luthfi-afif12/)
