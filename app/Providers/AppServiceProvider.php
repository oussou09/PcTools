<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }
    public function boot(): void
    {
/*
        Gate::define('update-product', function (User $user, Product $product) {
            dd("Checking gate", $user->id, $product->user_id);
            return $user->id === $product->user_id;
        });
*/
    }
}
