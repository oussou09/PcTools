<?php

namespace App\Models;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id'
    ];


    public function user() {
        return $this->belongsTo(User::class); // typically just 'user' not 'userCart'
    }

    public function products() {
        return $this->belongsToMany(Product::class, 'cart_product')
                    ->withPivot('quantity', 'total_price')
                    ->withTimestamps();
    }
}
