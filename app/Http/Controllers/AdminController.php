<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $totalUsers = User::count();
        $totalRestaurant = Restaurant::count();
        $Earnings = Order::where('status','Delivered')->select('grandTotal')->get()->toArray();
        $totalEarning = 0;
        foreach($Earnings as $earned){
            $totalEarning += $earned['grandTotal'] * 1.2;
        }
        return view('Admin.index',compact('totalUsers','totalRestaurant','totalEarning'));
    }
}
