<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    protected $fillable = ['users_id', 'orders_id', 'products_id', 'price', 'count'];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function order() {
        return $this->belongsTo(Orders::class);
    }
    public function product() {
        return $this->belongsTo(Products::class);
    }
}
