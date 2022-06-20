<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ImageController;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'total' => App\Models\Product::all()->count()
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(ProductController::class)->prefix('product')->group(function(){
    Route::get('/create', 'create')->name('product.create');
    Route::get('/', 'index')->name('product');
    Route::get('/{id}/edit', 'edit')->name('product');
    Route::post('/', 'store');
});

Route::controller(ImageController::class)->prefix('images')->group(function(){
    Route::get('/show/{id}', 'show');
    Route::post('/{id}', 'store');
});

require __DIR__.'/auth.php';
