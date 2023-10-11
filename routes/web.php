<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('index');
});

Route::get('navbar', function(){
    return view('navbar.navbar');
});

Route::get('signIn',function(){
    if(session()->get('username')){
        return redirect('/');
    }else{
        return view('Sign in.sign_in');
    }
})->name('sign_in');

Route::post('signUp', [UserController::class,'signUp'])->name('signup');
Route::post('login',[UserController::class,'login'])->name('login');