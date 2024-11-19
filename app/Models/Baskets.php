<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baskets extends Model
{
    protected $fillable = ['users_id', 'products_id', 'count', 'price', 'boolean'];

    public function product() {
        return $this->belongsTo(Products::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
