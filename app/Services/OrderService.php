<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Jobs\SendOrderConfirmation;
use Illuminate\Validation\ValidationException;

class OrderService
{
    public function __construct()
    {
        //
    }

    public function createOrder(array $data)
    {
        return DB::transaction(function () use ($data) {

            // Customer check or create
            $customer = Customer::firstOrCreate(
                [
                    'email' => $data['customer_email']
                ],
                [
                    'name' => $data['customer_name']
                ]
            );

            // Product + Stock check
            $subtotal = 0;
            $tax = 0;
            $orderItems = [];
            foreach ($data['products'] as $item) {

                $product = Product::where('id', $item['product_id'])
                    ->lockForUpdate()
                    ->firstOrFail();

             if ($product->stock < $item['quantity']) {
                throw ValidationException::withMessages([
                    'products' => ["Insufficient stock for {$product->name}."]
                ]);
}

                $lineSubtotal = $product->price * $item['quantity'];

                $lineTax = $lineSubtotal * ($product->tax_percentage / 100);
                $orderItems[] = ['product_id' => $product->id,
                                'quantity' => $item['quantity'],
                                'unit_price' => $product->price,
                                'tax_percentage' => $product->tax_percentage,
                                'line_subtotal' => $lineSubtotal,
                                'line_tax' => $lineTax,
                                'line_total' => $lineSubtotal + $lineTax];


                $subtotal += $lineSubtotal;
                $tax += $lineTax;

                $product->stock -= $item['quantity'];
                $product->save();
            }

            $grandTotal = $subtotal + $tax;

            $order = Order::create([
                'customer_id' => $customer->id,
                'subtotal' => $subtotal,
                'tax' => $tax,
                'grand_total' => $grandTotal,
            ]);
            foreach($orderItems as $orderItem){
                    OrderItem::create([
                                'order_id' => $order->id,
                                'product_id' => $orderItem['product_id'],
                                'quantity' => $orderItem['quantity'],
                                'unit_price' => $orderItem['unit_price'],
                                'tax_percentage' => $orderItem['tax_percentage'],
                                'line_subtotal' => $orderItem['line_subtotal'],
                                'line_tax' => $orderItem['line_tax'],
                                'line_total' => $orderItem['line_total'],
                                ]);
            }

            // Dispatch the job to send order confirmation email
            SendOrderConfirmation::dispatch($order->id)->afterCommit();

           return $order->load([
            'customer',
            'orderItems.product'
            ]);
        });
    }
}