<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'restaurant_id',
        'status',
        'payment',
        'notes',
        'address_id',
        'grandTotal',
        'cart_id'
    ];
}
