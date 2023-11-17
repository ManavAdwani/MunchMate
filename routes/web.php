<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\RestaurantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrdersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MainController::class,'homepage'])->name('homePage');

Route::get('navbar', function () {
    return view('navbar.navbar');
});

Route::get('restaurantNav', function () {
    return view('navbar.RestaurantNav');
});

// Route::get('signIn', function () {
//     // if (session()->get('username')) {
//     // return redirect('/');
//     // } else {
//     return view('Sign in.sign_in');
//     // }
// })->name('sign_in');

Route::get('signIn',[MainController::class,'signIn'])->name('sign_in');

Route::post('signUp', [UserController::class, 'signUp'])->name('signup');
Route::post('login', [UserController::class, 'login'])->name('login');

Route::get('Restaurant', function () {
    return view('Restaurant.index');
})->name('restaurantIndex');

Route::get('RestaurantPage', function () {
    return view('Restaurant.RestaurantPage');
})->name('restaurant');
Route::get('add-Restaurant', [RestaurantController::class, 'addRestaurant'])->name('addRestaurant');
Route::post('save-Restaurant', [RestaurantController::class, 'saveRestaurant'])->name('saveRestaurant');

Route::get('restaurant-login',[RestaurantController::class,'loginRes'])->name('restaurant_login');
Route::post('res-login',[RestaurantController::class,'restaurant_login'])->name('login_res');

Route::get('addMenu', function () {
    return view('Restaurant.addMenu');
})->name('addMenu');

Route::post('saveMenu',[RestaurantController::class, 'saveMenu'])->name('saveMenu');
Route::get('menu/{id}',[RestaurantController::class,'showMenu'])->name('showMenu');
Route::get('addProduct/{id}',[CartController::class,'addProduct'])->name('addProduct');
Route::get('cart',[CartController::class,'index'])->name('cartPage');
Route::post('/update-quantity',[CartController::class,'updateQuantity'])->name('updateQuantity');

Route::get('orders/{userId}/{restaurantid}',[OrdersController::class,'index'])->name('orders');