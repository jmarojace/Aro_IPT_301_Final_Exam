# Electronics Store Management System

A Laravel application for managing an electronics store catalog, suppliers, inventory, and sales.

Prices and sale totals are displayed in Philippine pesos (₱); the interface language is English.

## Features

- Manage categories, suppliers, and products with create, list, detail, update, and delete pages.
- Record sales with one or more products, validate available stock, and update inventory in a database transaction.
- Review sale invoices and line items. Sale items are created and edited with their parent sale; deleting a sale returns its quantities to stock.
- See validation errors and success or failure messages in the interface.
- Use responsive Bootstrap 5 styling loaded from a CDN.
- Generate related sample records with the model factories and `DatabaseSeeder`.

## Database

The application has five project tables:

1. `categories` has many products.
2. `suppliers` has many products.
3. `products` belongs to a category and a supplier, and has many sale items.
4. `sales` has many sale items.
5. `sale_items` belongs to a sale and a product.

Product references are protected from deletion while related records exist. Sale item records are removed with their sale, and the sales controller restores stock when a sale is deleted.

## Run locally with XAMPP on Windows

1. Start Apache and MySQL in the XAMPP Control Panel.
2. In phpMyAdmin, create a database named `electronics_store`.
3. Configure `.env` with the MySQL connection details. The default XAMPP example is `127.0.0.1:3306`, database `electronics_store`, username `root`, and an empty password. Keep `.env` private and do not commit it.
4. Install PHP dependencies and prepare the database:

   ```powershell
   composer install
   php artisan key:generate
   php artisan config:clear
   php artisan migrate --seed
   ```

5. Start the Laravel development server:

   ```powershell
   php artisan serve
   ```

6. Open `http://127.0.0.1:8000`.

The seeder creates sample categories, suppliers, products, sales, and sale items. If you need to rebuild a database from scratch, `php artisan migrate:fresh --seed` recreates it and **deletes all existing database data**.

## Project structure

- `app/Models` contains the five Eloquent models and their relationships.
- `app/Http/Controllers` contains the application logic and validation.
- `database/migrations` defines the five related project tables.
- `database/factories` and `database/seeders` provide sample data.
- `resources/views` contains the shared layout and Blade pages.
- `routes/web.php` defines the named dashboard and resource routes.

## GitHub submission

Commit the source code, migrations, views, factories, and seeders. Do not commit `.env`; submit `.env.example` for setup guidance. After pushing the repository, submit its URL in the required CASTLY project submission area.
# Aro_IPT_301_Final_Exam
