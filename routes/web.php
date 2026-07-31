<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Middleware\AdminCheckMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomepageController::class, 'index']);
Route::get('/shop', [ShopController::class, 'index']);
Route::view('/about', 'about');
Route::get('/contact', [ContactController::class, 'index']);
Route::post('/send-contact', [ContactController::class, 'sendContact'])->name('contact.send');

Route::middleware(['auth', AdminCheckMiddleware::class])->prefix('admin')->group(function () {
    Route::controller(ContactController::class)->prefix('/contact')->group(function () {
        Route::get('/all', 'getAllContacts')->name('all.contacts');
        Route::get('delete/{contact}', 'deleteContact')->name('admin.contact.delete');
        Route::get('/edit/{contact}', 'getContact')->name('admin.contact.edit');
        Route::post('/edit/{contact}', 'editContact')->name('admin.contact.update');
    });

    Route::controller(ProductController::class)->prefix('/product')->group(function () {
        Route::get('/add', 'index')->name('admin.product.add.index');
        Route::post('/add', 'addProduct')->name('admin.product.add');
        Route::get('/all', 'getAllProducts')->name('admin.all.products');
        Route::get('/delete/{product}', 'deleteProduct')->name('admin.product.delete');
        Route::get('/edit/{product}', 'getProduct')->name('admin.product.edit');
        Route::post('/edit/{product}', 'editProduct')->name('admin.product.update');
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
