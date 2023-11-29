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
    $order->save();
    $orderId = $order->id;
    $isAddressAvailable = Address::where('user_id', $userId)->select()->first();
    if (!empty($isAddressAvailable)) {
      $grandTotal = session()->get('grandTotal');
      $grandTotalInPaise = $grandTotal * 100;
      \Stripe\Stripe::setApiKey(config(key: 'stripe.sk'));
      $session = \Stripe\Checkout\Session::create([
        'line_items' => [
          [
            'price_data' => [
              'currency' => 'inr',
              'product_data' => [
                'name' => 'Order Id : 256',
              ],
              'unit_amount' => $grandTotalInPaise, // Euro 5.00
            ],
            'quantity' => 1,
          ],
        ],
        'mode' => 'payment',
        'success_url' => route('success'),
      ]);

      return redirect()->away($session->url);
    }
    else{
      return view('Payment.index')->with('orderId', $orderId);
    }
  }
}
