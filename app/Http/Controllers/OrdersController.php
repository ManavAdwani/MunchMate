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

    // Check if $cartIds is an array and has the first element as a string
    if (is_array($cartIds) && isset($cartIds[0]) && is_string($cartIds[0])) {
      // Decode the JSON string into an array
      $cartIds = json_decode($cartIds[0], true);
    }

    // Ensure cartIds are properly formatted as an array of integers
    $cartIds = array_map(function ($id) {
      return (int) filter_var($id, FILTER_SANITIZE_NUMBER_INT);
    }, $cartIds);

    // Fetch cart items
    $cartItems = Cart::whereIn('id', $cartIds)->get();

    if ($cartItems->isEmpty()) {
      return back()->with('error', 'Cart is empty');
    }

    $order = new Order;
    $order->user_id = $userId;
    $order->restaurant_id = $restaurantId;
    $order->status = "Order Received";
    $order->payment = "Online";
    $order->notes = "";
    $order->address_id = 0;
    $order->grandTotal = session()->get('grandTotal');
    $order->cart_id = 0;
    $order->save();

    // Save each item to order_items
    foreach ($cartItems as $item) {
      DB::table('order_items')->insert([
        'order_id' => $order->id,
        'product_id' => $item->product_id,
        'quantity' => $item->quantity,
        'price' => $item->price,
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }

    // Clear the cart only after storing order items
    Cart::whereIn('id', $cartIds)->delete();

    return view('Payment.index')->with('orderId', $order->id);
  }


  public function yourOrders()
  {
      $userId = session()->get('userId');
  
      $getAllOrders = DB::table('orders')
          ->select(
              'orders.id',
              'orders.restaurant_id',
              'restaurants.name as restaurant_name',
              'orders.status',
              'orders.grandTotal',
              'users.current_lat as driver_lat',
              'users.current_long as driver_long',
              'users.username as driver_name',
              DB::raw('GROUP_CONCAT(order_items.product_id) as product_ids'),
              DB::raw('GROUP_CONCAT(restaurant_menus.dish_name) as dish_names')
          )
          ->join('restaurants', 'restaurants.id', '=', 'orders.restaurant_id')
          ->join('order_items', 'order_items.order_id', '=', 'orders.id')
          ->join('restaurant_menus', 'restaurant_menus.id', '=', 'order_items.product_id')
          ->leftJoin('users', 'users.id', '=', 'orders.delivery_partner_id')
          ->where('orders.user_id', $userId)
          ->groupBy('orders.id', 'orders.restaurant_id', 'restaurants.name', 'orders.status', 'orders.grandTotal', 'users.current_lat', 'users.current_long', 'users.username')
          ->orderByDesc('orders.created_at')
          ->get();
  
      return view('yourOrders.index', compact('getAllOrders'));
  }
}
