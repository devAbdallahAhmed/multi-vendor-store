🌟 Multi Vendor Store
🏪 A modern and scalable multi-vendor e-commerce platform built with Laravel.
✨ Key Features

🛍️ Multi-Vendor System – each vendor manages their own products

📦 Product Management (CRUD + image upload)

🏷️ Categories & Tags

🛒 Shopping Cart (cookie-based)

💳 Checkout & Orders

📊 Vendor Dashboard

🔐 Authentication & Authorization

🧱 Clean Architecture using Repository Pattern

🧰 Tech Stack

Laravel

PHP

MySQL

Blade Templates

Repository Pattern

Eloquent ORM

🚀 Installation

git clone https://github.com/devAbdallahAhmed/multi-vendor-store

cd multi-vendor-store

composer install

cp .env.example .env

php artisan key:generate


php artisan migrate --seed
php artisan serve
