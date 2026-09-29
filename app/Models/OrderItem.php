<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;
    
    protected $fillable = [
    'order_id',
    'product_id',
    'quantity',
    'unit_price',
    'tax_percentage',
    'line_subtotal',
    'line_tax',
    'line_total',
];

    // Define the relationship with the order model
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Define the relationship with the product model
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
