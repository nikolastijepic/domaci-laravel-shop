<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Middleware\AdminCheckMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomepageController::class, 'index']);

Route::controller(ShopController::class)
    ->prefix('/shop')
    ->name('shop.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/product/{product}', 'show')->name('product.show');

        Route::controller(ShoppingCartController::class)
            ->prefix('/cart')
            ->name('cart.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/add', 'addToCart')->name('add');
                Route::delete('/remove/{product}', 'removeFromCart')->name('remove');
        });
});

Route::view('/about', 'about');
Route::get('/contact', [ContactController::class, 'index']);
Route::post('/send-contact', [ContactController::class, 'sendContact'])->name('contact.send');

Route::middleware(['auth', AdminCheckMiddleware::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
    Route::controller(ContactController::class)->prefix('/contact')->name('contact.')->group(function () {
        Route::get('/all', 'getAllContacts')->name('all');
        Route::get('delete/{contact}', 'deleteContact')->name('delete');
        Route::get('/edit/{contact}', 'getContact')->name('edit');
        Route::post('/edit/{contact}', 'editContact')->name('update');
    });

    Route::controller(ProductController::class)
        ->prefix('/product')
        ->name('product.')
        ->group(function () {
        Route::get('/add', 'index')->name('add.index');
        Route::post('/add', 'addProduct')->name('add');
        Route::get('/all', 'getAllProducts')->name('all');
        Route::get('/delete/{product}', 'deleteProduct')->name('delete');
        Route::get('/edit/{product}', 'getProduct')->name('edit');
        Route::post('/edit/{product}', 'editProduct')->name('update');
    });
});

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
