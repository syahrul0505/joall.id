<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('getProductAddById/{id}', [ProductController::class, 'getProductById']);

Route::group(['middleware' => ['auth']], function() {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('addToCart');
    Route::get('/orders', [OrderController::class, 'index'])->name('order');
    
});


Route::prefix('dashboard')
    ->middleware(['auth', 'admin'])
    ->group(function(){
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('products', ProductController::class);
        Route::get('getProductById/{id}', [ProductController::class, 'getProductById']);
        Route::post('updateProduct', [ProductController::class, 'update']);
        
        Route::resource('categories', CategoryController::class);
        Route::get('getCategoryById/{id}', [CategoryController::class, 'getCategoryById']);
        Route::post('updateCategory', [CategoryController::class, 'update']);
});