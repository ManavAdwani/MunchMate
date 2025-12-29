<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;



class MainController extends Controller
{
    public function homepage(Request $request){
        $ip = '103.251.219.178'; /* Static IP address */
        $currentUserInfo = Location::get($ip);
        // $restaurants = Restaurant::where('location','=',$currentUserInfo->regionName)->get();
        // For demo purposes, we will fetch all restaurants to ensure users see content
        $restaurants = Restaurant::all();
        // $ip = $request->ip();
        // dd($ip);
        // dd($currentUserInfo->regionName);
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
