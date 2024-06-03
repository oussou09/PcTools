<?php

use App\Http\Controllers\AdminControll;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductControll;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\UsersContoll;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Reaction;
use Illuminate\Support\Facades\Route;









Route::prefix('cart')->name('cart.')->group(function() {
    Route::get('/{id}',[CartController::class,'ShowCart'])->name('show');
    Route::post('/add/{productId}',[CartController::class,'AddToCart'])->name('add');
    Route::delete('/delete/cart/product/{productId}', [CartController::class, 'DeleteProduct'])->name('delete');
});







// Start-Auth

// Start-Making-Routes-Of-Crud-games
Route::middleware(['AuthUser'])->group(function () {
    Route::resource('product', ProductControll::class);
    Route::get('product/{slug}', [ProductControll::class, 'show'])->name('product.show');
    Route::get('product/my-product/{id}', [ProductControll::class, 'myproduct'])->name('product.myproduct');
    Route::put('product/{id}', [ProductControll::class, 'update'])->name('product.update');
    Route::post('product/{id}/like-and-dislike', [ReactionController::class, 'StoreReaction'])->name('product.StoreReaction');
    Route::get('product/product-i-like/{id}', [ReactionController::class, 'ShowAllProductLiked'])->name('product.ShowAllProductLiked');
});



Route::prefix('/')->name('home.')->group(function () {
    route::get('/',[HomeController::class,'home'])->name('home');
    route::get('/about',[HomeController::class,'about'])->name('about');
    route::get('/contact',[HomeController::class,'contact'])->name('contact');
    route::post('/contact',[HomeController::class,'store'])->name('store');
});

// End-Making-Routes-Of-Crud-games

// Start-Making-Routes-Of-User
Route::prefix('user')->name('user.')->group(function () {
    Route::middleware('AuthGuest')->group(function () {
        Route::get('/login',[UsersContoll::class,'loginuser'])->name('loginuser');
        Route::post('/login',[UsersContoll::class,'loginusereque'])->name('loginusereque');
        Route::get('/register',[UsersContoll::class,'registeruser'])->name('registeruser');
        Route::post('/register',[UsersContoll::class,'storeuser'])->name('storeuser');
    });
    Route::middleware(['AuthUser'])->group(function() {
        Route::get('/',[UsersContoll::class,'dashborduser'])->name('dashborduser');
        Route::get('/profile/{id}',[UsersContoll::class,'profileuser'])->name('profileuser');
        // Edit User
        Route::get('/edit/{id}',[UsersContoll::class,'edituser'])->name('edituser');
        Route::put('/edit/{id}',[UsersContoll::class,'updateuser'])->name('updateuser');
        Route::get('/edit/{id}/password',[UsersContoll::class,'updatepassuser'])->name('updatepassuser');
        Route::put('/edit/{id}/password-changing',[UsersContoll::class,'updatepassusereq'])->name('updatepassusereq');
        // Logout
        Route::post('/logout',[UsersContoll::class,'logoutuser'])->name('logoutuser');
    });

});
// End-Making-Routes-Of-User

// Start-Making-Routes-Of-Admin
Route::name('admin.')->prefix('wp-admin')->group(function() {
    Route::get('/login',[AdminControll::class,'loginAdmin'])->name('loginAdmin');
    Route::post('/login',[AdminControll::class,'loginAdminRequ'])->name('loginAdminRequ');
    Route::middleware('AuthAdmin')->group(function() {
        Route::get('/',[AdminControll::class,'homeadmin'])->name('homeadmin');
        Route::get('/show-users',[AdminControll::class,'listusers'])->name('listusers');
        Route::get('/messages-center',[AdminControll::class,'listcontact'])->name('listcontact');
        Route::post('/logout',[AdminControll::class,'logoutAdmin'])->name('logoutAdmin');
        route::get('/show-message/{id}', [AdminControll::class, 'showmessage'])->name('showmessage');
        route::post('/delete/{id}',[AdminControll::class,'destroymessage'])->name('destroymessage');
    });
});
// End-Making-Routes-Of-Admin

// End-Auth
