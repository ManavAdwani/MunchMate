<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
  public function index($userId, $restaurant_id)
  {
    $order = new order;
    $order->user_id = $userId;
    $order->restaurant_id = $restaurant_id;
    $order->status = "Order Recieved";
    $order->payment = "Online";
    $order->notes = "";
    $order->save();
    $findCart = Cart::where('user_id', $userId)->where('restaurant_id', $restaurant_id)->first();

    if ($findCart) {
      $findCart->delete();
    }

    return view('Payment.index');
  }
}
