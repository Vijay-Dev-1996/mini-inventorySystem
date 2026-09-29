<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderRequest;
use App\Services\OrderService;
class OrderController extends Controller
{
    public function __construct(
        private OrderService $orderService
    ){

    }
    // Create a new order
    public function store(StoreOrderRequest $request)
    {
        $data  = $request->validated();
        $order = $this->orderService->createOrder($data);
        return response()->json([
            'message' => 'Order request received',
            'data' => $order
        ]);
    }

    public function history($email)
    {
        $customer = \App\Models\Customer::where('email', $email)->firstOrFail();

        $orders = $customer->orders()->with('orderItems.product')->latest()->get();

         return response()->json($orders);
    }

    public function customerByEmail($email)
    {
    $customer = \App\Models\Customer::where('email', $email)->first();

    if (!$customer) {
        return response()->json([
            'message' => 'Customer not found'
        ], 404);
    }

    return response()->json($customer);
    }
}
