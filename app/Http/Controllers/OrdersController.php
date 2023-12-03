<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use DB;

class OrdersController extends Controller
{
  public function index(Request $request, $userId, $restaurantId)
  {
    $cartIds = $request->input('cartIds');
    $cartToDb = [];
    foreach ($cartIds as $cartId) {
      $cartToDb[] = $cartId;
    };
    $order = new Order;
    $order->user_id = $userId;
    $order->restaurant_id = $restaurantId;
    $order->status = "Order Recieved";
    $order->payment = "Online";
    $order->notes = "";
    $order->address_id = 0;
    $order->grandTotal = session()->get('grandTotal');
    $order->cart_id = implode(',', $cartToDb);
    $order->save();
    $orderId = $order->id;
    return view('Payment.index')->with('orderId', $orderId);
  }

  public function yourOrders()
  {
    $userId = session()->get('userId');
    // dd($getdetails);
    $getAllOrders = DB::table('orders')
      ->select('orders.restaurant_id','restaurants.name', 'orders.id', 'orders.status', 'orders.grandTotal','orders.cart_id')
      ->join('restaurants', 'restaurants.id', '=', 'orders.restaurant_id')
      ->where('orders.user_id', $userId)
      ->get();

    return view('yourOrders.index', compact('getAllOrders'));
  }
}
