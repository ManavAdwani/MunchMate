<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
  public function index($userId, $restaurantId)
  {
    $order = new Order;
    $order->user_id = $userId;
    $order->restaurant_id = $restaurantId;
    $order->status = "Order Recieved";
    $order->payment = "Online";
    $order->notes = "";
    $order->address_id = 0;
    $order->grandTotal = session()->get('grandTotal');
    $order->save();
    $orderId = $order->id;
    return view('Payment.index')->with('orderId', $orderId);
  }
}
