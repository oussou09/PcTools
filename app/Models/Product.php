<?php

namespace App\Models;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'gameName',
        'slug',
        'imageUrl',
        'price',
        'user_id',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function likedBy()
    {
        return $this->belongsToMany(User::class, 'reactions')->withTimestamps();
    }

    public function carts() {
        return $this->belongsToMany(Cart::class, 'cart_product');
    }



}
