<?php

use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Front\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SociolLoginController;
use App\Http\Controllers\Front\PaymentsController;




Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('product.show');

// Checkout


    Route::get('checkout', [CheckoutController::class, 'create'])->name('checkout');
    Route::post('checkout', [CheckoutController::class, 'store']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

 Route::get('auth/user/2fa', [App\Http\Controllers\Front\Auth\TowFactorAuthController::class, 'index'])->name('two-factor.index');



   Route::resource('/cart', CartController::class);



Route::get('/payments/{order}/pay', [App\Http\Controllers\Front\PaymentsController::class, 'create'])->name('orders.payments.create');

 Route::post('orders/{order}/stripe/paymeny-intent', [PaymentsController::class, 'createStripePaymentIntent'])
    ->name('stripe.paymentIntent.create');


Route::get('orders/{order}/pay/stripe/callback', [PaymentsController::class, 'confirm'])
    ->name('stripe.return');





    Route::get('auth/{provider}/redirect', [SociolLoginController::class, 'redirect'])->name('auth.socialite.redirect');
    Route::get('auth/{provider}/callback', [SociolLoginController::class, 'callback'])->name('auth.socialite.callback');

    Route::get('auth/{provider}/user', [App\Http\Controllers\SocialController::class, 'index'])->name('auth.social.user');

// require __DIR__ . '/auth.php';

require __DIR__ . '/dashboard.php';
