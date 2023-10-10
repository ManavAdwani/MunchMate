<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function signUp(Request $request){
        $request->validate([
          'username'=>'required',
          'email'=>'required|unique',
          'phone'=>'required',
          'pass'=>'required',
        ]);
    }
}
