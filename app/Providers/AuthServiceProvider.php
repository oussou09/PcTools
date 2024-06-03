<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\User;
use App\Policies\ProductPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        Product::class => ProductPolicy::class,
        User::class => UserPolicy::class,
    ];



    public function register(): void
    {
        //
    }

    public function boot(): void
{
    $this->registerPolicies();
}
}
