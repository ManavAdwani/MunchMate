<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Session;

class RestaurantController extends Controller
{
    public function addRestaurant(){
        return view('Restaurant.addRestaurant');
    }
    public function saveRestaurant(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:restaurants,email',
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
       $res->owner = session()->get('userId');
       if($pass == $cpass){
        $res->password = $pass;
        $res->owner = 1;
        $res->save();
        session()->put('userId',$res->owner);
        return redirect('addMenu');
       }
    }

    public function saveMenu(Request $request){
        dd($request->all());
    }
}
