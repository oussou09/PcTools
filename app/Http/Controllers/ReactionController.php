<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Reaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReactionController extends Controller
{
    public function StoreReaction(Request $request, $productId) {
        $user = $request->user('user');

        $product = Product::findOrFail($productId);
        if ($user->likes()->where('product_id', $product->id)->exists()) {
            $user->likes()->detach($product);
        } else {
            $user->likes()->attach($product);
        }
        return redirect()->back();
    }

    public function ShowAllProductLiked($id) {
        $user = User::findOrFail($id);
        $likedProduct = $user->likes()->paginate(8);
        return view('ResSite.ProductLiked',['likedProducts' => $likedProduct]);
    }

}
