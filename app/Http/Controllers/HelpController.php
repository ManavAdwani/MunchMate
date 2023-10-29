<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpController extends Controller
{
    public function helpPage(){
        if(session()->has('username')){
            return view('HelpPage.helpPage');
        }
        else{
            return view('Sign in.sign_in');
        }
    }
}
