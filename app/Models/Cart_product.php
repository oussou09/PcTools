<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart_product extends Model
{
    use HasFactory;

    public function cart() {
        return $this->belongsTo(Cart::class);
    }

    public function product() {
        return $this->belongsTo(Product::class); // You may need to define the inverse here if you're using this model.
    }

}
