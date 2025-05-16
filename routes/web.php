<?php

use App\Livewire\Cart;
use App\Livewire\CheckoutStatus;
use App\Livewire\Product;
use App\Livewire\StoreFront;
use App\Mail\OrderConfirmation;
use App\Models\Order;
use Illuminate\Support\Facades\Route;

Route::get('/', StoreFront::class)->name("home");
Route::get("/product/{productId}", Product::class)->name("product");
Route::get("/cart", Cart::class)->name("cart");
Route::get("/checkout-status", CheckoutStatus::class)->name("checkout-status");
Route::get("/preview", function () {
    $order = Order::first();
    return new OrderConfirmation($order);
});





























// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
