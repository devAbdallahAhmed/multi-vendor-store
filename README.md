Multi Vendor Store

Advanced multi-vendor e-commerce platform built with Laravel — vendors, products, carts, checkout, orders, payments (Stripe), notifications, API, and admin/vendor panels.

Table of Contents

About

Features

Tech Stack

Requirements

Installation

Environment variables (.env example)

Database & Seeding

Queue, Scheduler & Webhooks

Running the App

Testing

Deployment Notes

Contributing

License

ملخص بالعربي (Arabic Summary)

About

Multi Vendor Store is a full-featured e-commerce project built with Laravel demonstrating best practices: modular structure, repository pattern, facades, Eloquent relationships, authentication (Breeze/Fortify), payments integration with Stripe, API endpoints (Sanctum), notifications, events/listeners, queues, and deployment-ready configuration.

Repository: https://github.com/devAbdallahAhmed/multi-vendor-store

Features

Multi-vendor support (vendor registration, vendor dashboard)

Product management (CRUD, images, tags, categories)

Shopping cart (Repository pattern, scoped by cookie/user)

Checkout & Orders (Stripe integration for payments)

User authentication (Breeze + optional Fortify features)

Roles & permissions (admin / vendor / customer)

Notifications (mail, database, broadcast)

Events & Listeners for order workflow

Soft deletes, factories, and seeders

REST API with Sanctum for SPA/mobile

Localization support

Jobs, queues and scheduled tasks

Clean, documented codebase and README

Tech Stack

PHP 8.x

Laravel 10+

MySQL / MariaDB

Stripe (Payments)

Redis (recommended for queues & cache)

Composer & NPM

Vue / Livewire (optional front-end)

Git + GitHub

Requirements

PHP 8.1+

Composer

Node.js & npm/yarn

MySQL or MariaDB

Redis (optional but recommended)

OpenSSL, PDO, Mbstring, Tokenizer, XML, Ctype, JSON extensions

Installation

Clone the repository

git clone https://github.com/devAbdallahAhmed/multi-vendor-store.git
cd multi-vendor-store


Install PHP dependencies

composer install


Install JS dependencies and build assets

npm install
npm run dev    # or npm run build for production


Copy .env from example and set values

cp .env.example .env
php artisan key:generate


Fill .env values (database, stripe keys, mail, etc.) — see example below.

Environment variables (.env example)

Add these (at minimum) to your .env. Do not commit real keys. Use .env.example in repo.

APP_NAME="Multi Vendor Store"
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=multi_vendor_store
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=database
SESSION_DRIVER=file

# Stripe
STRIPE_KEY=pk_test_xxx
STRIPE_SECRET=sk_test_xxx
STRIPE_WEBHOOK_SECRET=whsec_xxx

# Mail (for notifications)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="noreply@example.com"
MAIL_FROM_NAME="${APP_NAME}"


Create .env.example with the same keys but empty values and commit that instead of .env.

Database & Seeding

Create the database configured in .env.

Run migrations and seeders:

php artisan migrate
php artisan db:seed    # runs DatabaseSeeder (creates sample vendors, users, categories, products)


If you prefer fresh install:

php artisan migrate:fresh --seed

Queue, Scheduler & Webhooks

Configure QUEUE_CONNECTION in .env (database/redis).

Run worker:

php artisan queue:work


Configure cron for scheduler (php artisan schedule:run every minute).

Stripe Webhooks

To process webhook events (payment succeeded, payment failed, etc.):

Expose your local app with stripe listen or ngrok and set STRIPE_WEBHOOK_SECRET in .env.

Register route in routes/web.php or use /stripe/webhook endpoint included in the project.

Make sure the webhook controller verifies the signature.
