<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\RestaurantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;
use App\Models\Restaurant;

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

Route::get('/', [MainController::class, 'homepage'])->name('homePage');

Route::get('navbar', function () {
    return view('navbar.navbar');
});

Route::get('restaurantNav', function () {
    return view('navbar.RestaurantNav');
});

Route::get('signIn', [MainController::class, 'signIn'])->name('sign_in');

Route::post('signUp', [UserController::class, 'signUp'])->name('signup');
Route::post('login', [UserController::class, 'login'])->name('login');
Route::get('logout', [UserController::class, 'logout'])->name('logout');

Route::get('Restaurant', [RestaurantController::class, 'index'])->name('indexpage');

Route::get('RestaurantPage', function () {
    return view('Restaurant.RestaurantPage');
})->name('restaurant');
Route::get('add-Restaurant', [RestaurantController::class, 'addRestaurant'])->name('addRestaurant');
Route::post('save-Restaurant', [RestaurantController::class, 'saveRestaurant'])->name('saveRestaurant');

Route::get('restaurant-login', [RestaurantController::class, 'loginRes'])->name('restaurant_login');
Route::post('res-login', [RestaurantController::class, 'restaurant_login'])->name('login_res');
Route::post('update-res-location', [RestaurantController::class, 'updateLocation'])->name('updateResLocation');

Route::get('addMenu', function () {
    return view('Restaurant.addMenu');
})->name('addMenu');

Route::post('saveMenu', [RestaurantController::class, 'saveMenu'])->name('saveMenu');
Route::get('menu/{id}', [RestaurantController::class, 'showMenu'])->name('showMenu');
Route::get('addProduct/{id}', [CartController::class, 'addProduct'])->name('addProduct');
Route::get('cart', [CartController::class, 'index'])->name('cartPage');
Route::post('/update-quantity', [CartController::class, 'updateQuantity'])->name('updateQuantity');

Route::get('get-new-orders', [RestaurantController::class, 'getNewOrders'])->name('getNewOrders');
Route::get('changeOrderStatus/{OrderId}/{orderStatus}', [RestaurantController::class, 'changeOrderStatus'])->name('changeOrderStatus');
Route::get('addAddress/{userId}/{restaurantId}', [
    'as' => 'paymentPage',
    'uses' => 'App\Http\Controllers\PaymentController@index'
]);
Route::post('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
Route::get('success', [PaymentController::class, 'success'])->name('success');
Route::post('orderCheckout/{userId}/{restaurantid}', [OrdersController::class, 'index'])->name('orderCheckout');
Route::get('backToCart/{orderId}', [PaymentController::class, 'backToCart'])->name('backToCart');
Route::post('countItems', [CartController::class, 'countItems'])->name('countItems');
Route::get('deleteCartItem/{cartId}', [CartController::class, 'deleteItem'])->name('deleteItem');
Route::get('payment/{OrderId}/{addressIs}', [PaymentController::class, 'payment'])->name('payment');

Route::get('orderDetails', [OrdersController::class, 'yourOrders'])->name('yourOrders');

// Admin panel
Route::get('admin-side', [AdminController::class, 'index'])->name('admin-panel');

Route::get('add-menu', [RestaurantController::class, 'add_menu'])->name('menu-add');

Route::get('restaurantMenu', [RestaurantController::class, 'restaurantMenu'])->name('restaurantMenu');
Route::get('deleteMenu/{menuId}', [RestaurantController::class, 'deleteMenu'])->name('deleteMenu');

Route::get('users',[AdminController::class,'res_users'])->name('res_users');
Route::get('add-users',[AdminController::class,'add_res_user'])->name('add_res_user');
Route::post('save-user',[AdminController::class,'save_user'])->name('save_user');

Route::get('delete-user/{id}',[AdminController::class,'delete_user'])->name('delete_user');
Route::get('edit-user/{id}',[AdminController::class,'edit_user'])->name('edit_user');
Route::post('update-user/{id}',[AdminController::class,'update_user'])->name('update_user');

// Delivery Partner Routes
use App\Http\Controllers\DeliveryController;
Route::group(['prefix' => 'delivery'], function () {
    Route::get('/', [DeliveryController::class, 'index'])->name('delivery_dashboard');
    Route::get('/login', [DeliveryController::class, 'login'])->name('delivery_login');
    Route::post('/login', [DeliveryController::class, 'authenticate'])->name('delivery_check_login');
    Route::get('/signup', [DeliveryController::class, 'signup'])->name('delivery_signup');
    Route::post('/signup', [DeliveryController::class, 'register'])->name('delivery_register');
    Route::get('/accept/{id}', [DeliveryController::class, 'acceptOrder'])->name('delivery_accept');
    Route::get('/picked-up/{id}', [DeliveryController::class, 'pickedUp'])->name('delivery_picked_up');
    Route::get('/delivered/{id}', [DeliveryController::class, 'delivered'])->name('delivery_delivered');
    Route::post('/update-location', [DeliveryController::class, 'updateLocation'])->name('delivery_update_location');
});