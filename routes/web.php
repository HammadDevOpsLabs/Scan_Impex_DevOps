<?php

use App\Http\Controllers\PayPalController;
use App\Http\Controllers\ProductController;
use App\Models\Order;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Route;



Auth::routes();

Route::get('/test', function (){

})->name('ho00me');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/shop', [ProductController::class,'index'])->name('shop');
Route::get('/cart', [\App\Http\Controllers\CartController::class,'ShowCart'])->middleware('auth')->name('cart');
Route::post('/cart/{product_id}/remove', [\App\Http\Controllers\CartController::class,'removeFromCart'])->middleware('auth')->name('remove-from-cart');
Route::post('/add-to-cart/{product_id}', [\App\Http\Controllers\CartController::class,'addToCart'])->middleware('auth')->name('add-to-cart');
Route::get('/update-quantity/{item}', [\App\Http\Controllers\CartController::class,'changeQuantity'])->middleware('auth')->name('update-quantity');
Route::get('/checkout', [\App\Http\Controllers\OrderController::class,'checkout'])->middleware('auth')->name('checkout');
Route::post('/place-order', [\App\Http\Controllers\OrderController::class,'placeOrder'])->middleware('auth')->name('place-order');
Route::get('/profile', [\App\Http\Controllers\HomeController::class,'userProfile'])->middleware('auth')->name('profile');
Route::post('/profile/update', [\App\Http\Controllers\HomeController::class,'userProfileUpdate'])->middleware('auth')->name('update-profile');
Route::get('contact', function (){
    return view('contact');
})->name('contact');

Route::group(['prefix'=>'products','as'=>'products.',],function (){
    Route::get('category/{slug}',[ProductController::class,'ProductByCategory'])->name('by-category');
    Route::get('show/{slug}',[ProductController::class,'show'])->name('show');
});

Route::get('order/{order_id}/items',[\App\Http\Controllers\OrderController::class,'OrderItems'])->name('order-items');



Route::get('process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');
Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');


