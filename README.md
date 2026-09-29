# Store Order & Inventory System

A Laravel-based Store Order and Inventory Management System developed as a take-home assignment.

## Features

* Product management with name, unique code, price, tax percentage and stock
* Customer management with unique email
* Create orders with one or more products
* Automatic subtotal, tax and grand total calculation
* Stock availability validation
* Automatic stock deduction after order creation
* Customer order history by email
* Low-stock product API with configurable threshold
* Queue-based order confirmation email simulation
* Safe concurrent stock deduction using database transactions and row locking
* PHPUnit feature tests

## Requirements

* PHP 8.x
* Laravel
* MySQL
* Composer
* XAMPP or another local PHP environment

## Installation

### 1. Install Dependencies

```bash
composer install
```

### 2. Configure Environment

Copy `.env.example` to `.env`:

```bash
copy .env.example .env
```

Configure the database in `.env`:

```env
DB_DATABASE=store_order
DB_USERNAME=root
DB_PASSWORD=
```

Configure the queue:

```env
QUEUE_CONNECTION=database
```

Configure the low-stock threshold:

```env
LOW_STOCK_THRESHOLD=5
```

### 3. Generate Application Key

```bash
php artisan key:generate
```

### 4. Run Migrations

```bash
php artisan migrate
```

### 5. Start Laravel Server

```bash
php artisan serve
```

The API will be available at:

```text
http://localhost:8000/api
```

## API Endpoints

### Get Products

```text
GET /api/products
```

### Get Low-Stock Products

```text
GET /api/products/low-stock
```

### Create Order

```text
POST /api/orders
```

Example request:

```json
{
    "customer_name": "Test Customer",
    "customer_email": "test@example.com",
    "products": [
        {
            "product_id": 1,
            "quantity": 2
        }
    ]
}
```

### Get Customer Order History

```text
GET /api/customers/{email}/orders
```

### Find Customer by Email

```text
GET /api/customers/by-email/{email}
```

## Stock Validation

Before creating an order, the system checks whether sufficient stock is available.

If the requested quantity is greater than the available stock:

* The order is rejected.
* A validation error is returned.
* Product stock remains unchanged.

## Concurrent Stock Handling

The application protects stock from being oversold when multiple order requests target the same product.

Order creation is performed inside a database transaction using `lockForUpdate()`.

The product row is locked before checking and deducting stock.

Example:

```text
Request A → Lock product → Check stock → Deduct stock → Commit
Request B → Wait for lock → Check updated stock → Create or reject order
```

This ensures that stock is checked against the latest available quantity and prevents incorrect stock deduction.

## Queue Job

When an order is successfully created, the `SendOrderConfirmation` queue job is dispatched.

The application does not send a real email. Instead, it simulates the confirmation email and records the result in the Laravel log.

Start the queue worker:

```bash
php artisan queue:work
```

Log file:

```text
storage/logs/laravel.log
```

## Low Stock Configuration

The low-stock threshold is configurable through `.env`:

```env
LOW_STOCK_THRESHOLD=5
```

Products with stock below this threshold are returned by:

```text
GET /api/products/low-stock
```

## Testing

The project uses PHPUnit feature tests.

Run all tests:

```bash
php artisan test
```

The tests cover:

* Successful order creation
* Subtotal, tax and grand total calculation
* Stock deduction
* Insufficient stock validation
* Preventing order creation when stock is insufficient
* Concurrent stock protection

Current test result:

```text
Tests: 5 passed (15 assertions)
```

## Frontend

AI-Assisted Development

The frontend UI was developed with the help of GitHub Copilot.
The prompts used during development are included in the /prompts folder.

The project includes a Store Billing interface that supports:

* Customer search by email
* Product selection
* Quantity entry
* Multiple products in an order
* Automatic bill total calculation
* Generate Bill
* Order History
* Low-stock product visibility

## Notes

* Email delivery is simulated using the Laravel queue and application log.
* No real SMTP configuration is required.
* Stock deduction is protected using database transactions and row-level locking.
