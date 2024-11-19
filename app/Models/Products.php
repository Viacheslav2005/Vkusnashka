<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Orders;
use App\Models\Categories;

class Products extends Model
{
    protected $fillable = ["image", "title", "description", "price", "country", "count", "categories_id", "structure"];

    public function basket() {
        return $this->hasMany(Baskets::class);
    }
    public function categories() {
        return $this->belongsTo(Categories::class);
    }
    public function order_details() {
        return $this->belongsTo(Order_detail::class);
    }
}
