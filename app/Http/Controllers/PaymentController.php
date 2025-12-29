<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        $address = new Address();
        $email = $request->email;
        $userId = User::where('email', $email)->select('id')->first();
        $user_id = $userId->id ?? 0;
        $ad1 = $request->address;
        $ad2 = $request->address2;
        $fullAddress = $ad1 . $ad2;
        $address->address = $fullAddress;
        $address->city = $request->city ?? 'Ahmedabad';
        $address->state = $request->state ?? 'Gujarat';
        $address->pincode = $request->zip;
        $address->user_id = $user_id;
        $grandTotal = session()->get('grandTotal');
        $grandTotalInPaise = $grandTotal * 100;

        $address->save();

        $getOrderId = Order::where('user_id', $user_id)
            ->orderBy('id', 'desc')
            ->select('id')
            ->first();
        $orderId = $getOrderId->id;
        $getOrderDetails = Order::find($orderId);
        if ($getOrderDetails) {
            $getOrderDetails->address_id = $address->id;
            $getOrderDetails->update();
        }
        \Stripe\Stripe::setApiKey(config(key: 'stripe.sk'));
        $session = \Stripe\Checkout\Session::create([
            'customer_email' => $email, // Required for compliance
            'billing_address_collection' => 'required', // Ensures address is collected
            'payment_method_types' => ['card'],
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
    public function success()
    {
        $userId = session()->get('userId');
        $getLastOrder = Cart::where('user_id', $userId)->orderBy('id', 'desc')->first();
        if (!empty($getLastOrder)) {
            $getLastOrder->delete();
        }
        return view('orderplaced');
    }

    public function backToCart(Request $request, $orderId)
    {
        // 1. Find the order with its items
        $order = Order::find($orderId);

        if (!$order) {
            return view('Cart.emptyCart');
        }

        // 2. Retrieve order items
        $orderItems = DB::table('order_items')->where('order_id', $orderId)->get();

        // 3. Restore items to Cart
        if ($orderItems->isNotEmpty()) {
            foreach ($orderItems as $item) {
                // Check if this specific item combination already exists to avoid duplicates 
                // (though technically we are restoring a previous state, checking is safer)
                // However, since we cleared the cart, we can just insert.
                
                $cart = new Cart();
                $cart->user_id = $order->user_id;
                $cart->product_id = $item->product_id;
                $cart->restaurant_id = $order->restaurant_id;
                $cart->quantity = $item->quantity;
                $cart->price = $item->price;
                $cart->created_at = now();
                $cart->updated_at = now();
                $cart->save();
            }
        }

        // 4. Delete the Order and Order Items
        // Note: order_items should cascade delete if set up in DB, but explicit delete is safer if not.
        DB::table('order_items')->where('order_id', $orderId)->delete();
        $order->delete();

        // 5. Redirect to Cart Page
        // We don't need to pass all the data because the CartController will fetch it from DB
        return redirect()->route('cartPage');
    }

    public function payment($orderId, $addressId)
    {
        $getOrderDetails = Order::find($orderId);
    
        if (!$getOrderDetails) {
            return back()->with('error', 'Something went wrong !!');
        }
    
        $getOrderDetails->address_id = $addressId;
        $getOrderDetails->update();
    
        $grandTotal = $getOrderDetails->grandTotal;
        $grandTotalInPaise = $grandTotal * 100;
    
        // Retrieve user ID from session
        $userId = session()->get('userId');
    
        if (!$userId) {
            return back()->with('error', 'User not logged in.');
        }
    
        // Fetch user details
        $customer = User::find($userId);
    
        if (!$customer) {
            return back()->with('error', 'User not found.');
        }
    
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $session = \Stripe\Checkout\Session::create([
            'customer_email' => $customer->email, // Required for compliance
            'billing_address_collection' => 'required', // Ensures address is collected
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'inr',
                        'product_data' => [
                            'name' => 'Order ID: ' . $orderId,
                        ],
                        'unit_amount' => $grandTotalInPaise,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('success', ['orderId' => $orderId]),
            // 'cancel_url' => route('payment.cancel', ['orderId' => $orderId]),
            'shipping_address_collection' => [ // Use this to collect shipping address
                'allowed_countries' => ['IN'], // Restrict to India
            ],
        ]);
        return redirect()->away($session->url);
        
    
        return redirect()->away($session->url);
    }
    
    
}
