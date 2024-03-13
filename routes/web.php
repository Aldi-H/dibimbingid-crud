<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::middleware('guest')->get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'attempt'])->name('login.attempt');
Route::middleware('auth')->get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/home', function () {
    return view('home');
})->middleware(['auth'])->name('home');

// --- PRODUCTS ROUTE ---- //
Route::middleware(['auth'])->group(function() {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
});