<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Product;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function ShowCart($id) {
        $user = User::findOrFail($id);
        if (!$user->cart) {
            return abort(404);
        }
        $cart = $user->cart->products;
        // dd($cart);
        return view('ResSite.cart.DetailsCart',[
            'CartItems' => $cart
        ]);
    }

    public function AddToCart($productId) {

        $userId = Auth::guard('user')->user()->id;
        $quantity = 1;

        $cart = Cart::firstOrCreate(['user_id' => $userId]);  // Get the cart or create a new one
        //dd($cart);
        $product = Product::find($productId);
        //dd($product);

        if (!$product) {
            return abort(404);
        }

        if ($cart->products()->find($productId)) {
            // If product exists in the cart, update the quantity
            $cart->products()->updateExistingPivot($productId, [
                'quantity' => DB::raw('quantity + ' . $quantity), // Increment the quantity
                'total_price' => DB::raw('total_price + ' . ($product->price * $quantity)) // Update the total price
            ]);
        } else {
            // If not, add the product to the cart
            $cart->products()->attach($productId, [
                'quantity' => $quantity,
                'total_price' => $product->price * $quantity  // Assuming you have a price field in your products table
            ]);
        }

        return redirect()->back()->with(['message' => 'Product added to cart successfully']);
    }
    public function DeleteProduct($productId) {
        $product = Product::findOrFail($productId);
        $user = Auth::guard('user')->user(); // Ensure you're getting the current user
        $cart = $user->cart; // Get the user's cart

        if (!$cart) {
            return abort(404);
        }

        $cart->products()->detach($product); // Detach the product from the cart
        return back()->with('success', 'Product removed from cart successfully!');
    }
}
