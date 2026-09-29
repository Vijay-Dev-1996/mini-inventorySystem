<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
{
    return response()->json(
        \App\Models\Product::orderBy('name')->get()
    );
}

    public function lowStock()
{
    $threshold = config('store.low_stock_threshold');

    $products = \App\Models\Product::where('stock', '<', $threshold)->get();

    return response()->json($products);
}
}
