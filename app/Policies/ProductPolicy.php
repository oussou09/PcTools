<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    // public function viewAny(User $user): bool{}

    // public function view(User $user, Product $product): bool{}

    // public function create(User $user): bool{}

    public function update(User $user, Product $product) {
        return $user->id === $product->user_id;
    }

    public function view(User $user, Product $product) {
        return $user->id === $product->user_id;
    }

    public function show(User $user, Product $product) {
        return $user->id === $product->user_id;
    }

    public function delete(User $user, Product $product) {
        return $user->id === $product->user_id;
    }

    // public function restore(User $user, Product $product): bool{}

    // public function forceDelete(User $user, Product $product): bool{}
}
