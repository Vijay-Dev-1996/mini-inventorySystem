<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Order extends Model
{
     use HasFactory;

 protected $fillable = [
    'customer_id',
    'subtotal',
    'tax',
    'grand_total',
];

// Define the relationship with the customer model
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Define the relationship with the order items model
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
  
}
