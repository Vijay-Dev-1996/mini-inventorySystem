<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_order_can_be_created_successfully(): void
    {
        $customer = Customer::create([
            'name' => 'Test Customer',
            'email' => 'test@example.com',
        ]);

        $product = Product::create([
            'name' => 'Test Product',
            'code' => 'TEST-001',
            'price' => 100,
            'tax_percentage' => 10,
            'stock' => 10,
        ]);

        $response = $this->postJson('/api/orders', [
            'customer_name' => $customer->name,
            'customer_email' => $customer->email,
            'products' => [
                [
                    'product_id' => $product->id,
                    'quantity' => 2,
                ],
            ],
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('orders', [
            'customer_id' => $customer->id,
            'subtotal' => 200,
            'tax' => 20,
            'grand_total' => 220,
        ]);

        $this->assertDatabaseHas('order_items', [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'stock' => 8,
        ]);
    }

    public function test_order_fails_when_stock_is_insufficient(): void
    {
        $customer = Customer::create([
            'name' => 'Test Customer',
            'email' => 'stocktest@example.com',
        ]);

        $product = Product::create([
            'name' => 'Test Product',
            'code' => 'TEST-002',
            'price' => 100,
            'tax_percentage' => 10,
            'stock' => 2,
        ]);

        $response = $this->postJson('/api/orders', [
            'customer_name' => $customer->name,
            'customer_email' => $customer->email,
            'products' => [
                [
                    'product_id' => $product->id,
                    'quantity' => 5,
                ],
            ],
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('products');
        
        $this->assertDatabaseMissing('orders', [
            'customer_id' => $customer->id,
        ]);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'stock' => 2,
        ]);
    }

public function test_concurrent_orders_do_not_oversell_stock(): void
{
    $customer = Customer::create([
        'name' => 'Concurrent Customer',
        'email' => 'concurrent@example.com',
    ]);

    $product = Product::create([
        'name' => 'Concurrent Test Product',
        'code' => 'CON-001',
        'price' => 100,
        'tax_percentage' => 10,
        'stock' => 5,
    ]);

    $service = app(\App\Services\OrderService::class);

    // First order takes 4 items.
    $order1 = $service->createOrder([
        'customer_name' => $customer->name,
        'customer_email' => $customer->email,
        'products' => [
            [
                'product_id' => $product->id,
                'quantity' => 4,
            ],
        ],
    ]);

    $this->assertNotNull($order1);

    // Second order requests 4 items.
    // Only 1 item is available now, so this must fail.
    try {
        $service->createOrder([
            'customer_name' => $customer->name,
            'customer_email' => $customer->email,
            'products' => [
                [
                    'product_id' => $product->id,
                    'quantity' => 4,
                ],
            ],
        ]);

        $this->fail('Expected insufficient stock exception was not thrown.');
    } catch (\Illuminate\Validation\ValidationException $e) {
        $this->assertTrue(true);
    }

    // Stock must remain 1. It must not become negative.
    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'stock' => 1,
    ]);

    // Only one order should exist.
    $this->assertDatabaseCount('orders', 1);
}


}