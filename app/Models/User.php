<?php

namespace App\Models;



// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'account_type',
    ];

    protected $casts = [
        'account_type' => 'integer',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function products() {
        return $this->hasMany(Product::class,'user_id');
    }

    public function likes()
    {
        return $this->belongsToMany(Product::class, 'reactions')->withTimestamps();
    }

    public function cart() {
        return $this->hasOne(Cart::class);
    }






    public function isSeller()
    {
        return $this->account_type === 1;
    }

    public function isBuyer()
    {
        return $this->account_type === 0;
    }
}
