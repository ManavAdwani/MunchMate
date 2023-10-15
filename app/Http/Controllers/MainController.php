<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function homepage(){
        return view('index');
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
