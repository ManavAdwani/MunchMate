<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function addRestaurant(){
        return view('Restaurant.addRestaurant');
    }
    public function saveRestaurant(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'pass'=>'required',
            'cpass'=>'required'
        ]);

       $res = new Restaurant;
       $res->name = $request->input('name');
       $res->email = $request->input('email');
       $res->phone = $request->input('phone');
       $pass = $request->input('pass');
       $cpass = $request->input('cpass');
       if($pass == $cpass){
        $res->password = $pass;
        $res->owner = 1;
        $res->save();
        return view('addMenu');
       }
    }
}
