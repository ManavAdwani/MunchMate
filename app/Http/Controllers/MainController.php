<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function homepage(){
        $restaurants = Restaurant::all();
        $allRes = Restaurant::orderBy('id','DESC')->get();
        return view('index',compact('restaurants','allRes'));
    }

    public function signIn(){
        if(session()->has('username')){
            return back();
        }
        else{
            return view('Sign in.sign_in');
        }
    }


}
