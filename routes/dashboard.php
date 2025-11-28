<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'admin/dashboard',
    'as' => 'dashboard.',
    'middleware' => ['auth:admin', ],
], function () {

    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');
    Route::get('/categories/trash', [CategoryController::class, 'trash'])->name('categories.trash');
    Route::put('/categories/{category}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::delete('/categories/{category}/force-delete', [CategoryController::class, 'forceDelete'])->name('categories.force-delete');

    // products
    Route::get('/products/trash', [ProductController::class, 'trash'])->name('products.trash');
    Route::put('/products/{category}/restore', [ProductController::class, 'restore'])->name('products.restore');
    Route::delete('/products/{category}/force-delete', [ProductController::class, 'forceDelete'])->name('products.force-delete');
    Route::get('view/desc/{id}', [ProductController::class, 'viewDesc'])->name('view.desc');

    //Profiles
    Route::get('profiles/update', [ProfileController::class, 'edit'])->name('profiles.edit');
    Route::patch('profiles/update', [ProfileController::class, 'update'])->name('profiles.update');;

    //resource
    Route::resource('/categories', CategoryController::class)->middleware('auth');
    Route::resource('/products', ProductController::class)->middleware('auth');
});
