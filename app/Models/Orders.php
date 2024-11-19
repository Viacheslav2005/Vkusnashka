<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Products;

class Orders extends Model
{
    protected $fillable = ["users_id", "product_id", "amount", "status", "name_users"];

    public function order_detail() {
        return $this->hasMany(Order_detail::class);
    }

}
