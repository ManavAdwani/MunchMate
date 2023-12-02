<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\User;

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
        $getOrder = Order::where('id', $orderId)->first();
        if ($getOrder) {
            $getOrder->delete();
            $userId = session()->get('userId');
            if ($userId) {
                $products = Cart::where('user_id', $userId)->join('users', 'users.id', '=', 'carts.user_id')->join('restaurant_menus', 'restaurant_menus.id', '=', 'carts.product_id')->select('carts.id as cartId', 'restaurant_menus.dish_name as dish_name', 'restaurant_menus.description as dish_desc', 'restaurant_menus.price as price', 'restaurant_menus.dish_pic as dish_pic', 'carts.quantity as qty')->get();
                if (!empty($products)) {
                    $resId = Cart::where('user_id', $userId)->join('users', 'users.id', '=', 'carts.user_id')->join('restaurant_menus', 'restaurant_menus.id', '=', 'carts.product_id')->select('carts.restaurant_id as ResId')->first();
                    if (!empty($resId)) {
                        $restaurant_id = $resId->ResId;
                        $totalPrice = 0;
                        foreach ($products as $product) {
                            $totalPrice += $product->qty * $product->price;
                        }
                        $grandTotal = $totalPrice + 45;
                        $totalCount = Cart::where('user_id', $userId)->join('users', 'users.id', '=', 'carts.user_id')->join('restaurant_menus', 'restaurant_menus.id', '=', 'carts.product_id')->select('restaurant_menus.dish_name as dish_name', 'restaurant_menus.description as dish_desc', 'restaurant_menus.price as price', 'restaurant_menus.dish_pic as dish_pic')->count();
                        session()->put('grandTotal', $grandTotal);
                        return redirect()->route('cartPage', ['userId' => $userId, 'restaurantid' => $restaurant_id])->with(compact('products', 'totalCount', 'totalPrice', 'grandTotal'));
                    } else {
                        return view('Cart.emptyCart');
                    }
                } else {
                    return view('Cart.emptyCart');
                }
            } else {
                return view('Sign in.sign_in');
            }
        }
    }

    public function payment($orderId, $addressId)
    {
        $getOrderDetails = Order::find($orderId);
        if ($getOrderDetails) {
            $getOrderDetails->address_id = $addressId;
            $getOrderDetails->update();
            $grandTotal = $getOrderDetails->grandTotal;
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
        } else {
            return back()->with('error', 'Something went wrong !!');
        }
    }
}
