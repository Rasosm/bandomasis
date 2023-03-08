<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestorantController as R;
use App\Http\Controllers\DishController as D;
use App\Http\Controllers\FrontController as F;
use App\Http\Controllers\OrderController as O;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [F::class, 'home'])->name('start');
Route::get('/dish/{dish}', [F::class, 'showDish'])->name('show-dish');
Route::post('/add-to-cart', [F::class, 'addToCart'])->name('add-to-cart');
Route::get('/cart', [F::class, 'cart'])->name('cart');
Route::post('/cart', [F::class, 'updateCart'])->name('update-cart');
Route::post('/make-order', [F::class, 'makeOrder'])->name('make-order')->middleware('roles:A|M|C');
Route::post('/rate', [F::class, 'rate'])->name('rate')->middleware('roles:A|M|C');


Route::prefix('admin/restorants')->name('restorants-')->group(function () {
    Route::get('/', [R::class, 'index'])->name('index')->middleware('roles:A|M');
    Route::get('/create', [R::class, 'create'])->name('create')->middleware('roles:A|M');
    Route::post('/create', [R::class, 'store'])->name('store')->middleware('roles:A|M');
    Route::get('/edit/{restorant}', [R::class, 'edit'])->name('edit')->middleware('roles:A|M');
    Route::put('/edit/{restorant}', [R::class, 'update'])->name('update')->middleware('roles:A|M');
    Route::delete('/delete/{restorant}', [R::class, 'destroy'])->name('delete')->middleware('roles:A|M');
});

Route::prefix('admin/dishes')->name('dishes-')->group(function () {
    Route::get('/', [D::class, 'index'])->name('index')->middleware('roles:A|M');
    Route::get('/show/{dish}', [D::class, 'show'])->name('show')->middleware('roles:A|M');
    Route::get('/pdf/{dish}', [D::class, 'pdf'])->name('pdf')->middleware('roles:A|M');
    Route::get('/create', [D::class, 'create'])->name('create')->middleware('roles:A|M');
    Route::post('/create', [D::class, 'store'])->name('store')->middleware('roles:A|M');
    Route::get('/edit/{dish}', [D::class, 'edit'])->name('edit')->middleware('roles:A|M');
    Route::put('/edit/{dish}', [D::class, 'update'])->name('update')->middleware('roles:A|M');
    Route::delete('/delete/{dish}', [D::class, 'destroy'])->name('delete')->middleware('roles:A|M');
    
});

Route::prefix('admin/orders')->name('orders-')->group(function () {
    Route::get('/', [O::class, 'index'])->name('index')->middleware('roles:A|M');
    Route::put('/edit/{order}', [O::class, 'update'])->name('update')->middleware('roles:A');
    Route::delete('/delete/{order}', [O::class, 'destroy'])->name('delete')->middleware('roles:A');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
