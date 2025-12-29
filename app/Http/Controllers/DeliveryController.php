<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DeliveryController extends Controller
{
    public function login()
    {
        return view('Delivery.auth.login');
    }

    public function signup()
    {
        return view('Delivery.auth.signup');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric|unique:users,phone_number',
            'pass' => 'required',
            'cpass' => 'required|same:pass'
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone_number = $request->phone;
        $user->password = $request->pass; 
        $user->role = 3; // Delivery Partner Role
        $user->save();

        session()->put('username', $user->username);
        session()->put('userId', $user->id);

        return redirect()->route('delivery_dashboard');
    }

    public function authenticate(Request $request) 
    {
        $request->validate([
            'phone' => 'required',
            'pass' => 'required'
        ]);

        $user = User::where('phone_number', $request->phone)->first();

        if ($user && $user->password === $request->pass) {
            if ($user->role == 3) {
                session()->put('username', $user->username);
                session()->put('userId', $user->id);
                return redirect()->route('delivery_dashboard');
            } else {
                return back()->with('error', 'Unauthorized. Not a delivery partner.');
            }
        }

        return back()->with('error', 'Invalid Credentials');
    }

    // Dashboard
    public function index()
    {
        $userId = session()->get('userId');
        if (!$userId) {
            return redirect()->route('delivery_login');
        }

        // Calculate Earnings
        $todayEarnings = DB::table('orders')
            ->where('delivery_partner_id', $userId)
            ->where('status', 'Order delivered')
            ->whereDate('updated_at', today())
            ->sum('delivery_fee');

        $totalEarnings = DB::table('orders')
            ->where('delivery_partner_id', $userId)
            ->where('status', 'Order delivered')
            ->sum('delivery_fee');

        // Check for Active Order (Assigned or Out for Delivery)
        $activeOrder = DB::table('orders')
            ->leftJoin('restaurants', 'orders.restaurant_id', '=', 'restaurants.id')
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->leftJoin('addresses', 'orders.address_id', '=', 'addresses.id')
            ->select(
                'orders.id',
                'orders.grandTotal',
                'orders.status',
                'orders.delivery_fee',
                'restaurants.name as restaurant_name',
                'restaurants.location as restaurant_location',
                'restaurants.phone as restaurant_phone',
                'users.username as customer_name',
                'users.phone_number as customer_phone',
                'addresses.address as customer_address',
                'addresses.city as customer_city',
                'addresses.state as customer_state',
                'addresses.pincode as customer_pincode'
            )
            ->where('orders.delivery_partner_id', $userId)
            ->whereIn('orders.status', ['Driver Assigned', 'Out for Delivery'])
            ->first();

        if ($activeOrder) {
            return view('Delivery.active', compact('activeOrder'));
        }

        // Available Orders
        $availableOrders = DB::table('orders')
            ->join('restaurants', 'orders.restaurant_id', '=', 'restaurants.id')
            ->select(
                'orders.id',
                'orders.grandTotal',
                'orders.created_at',
                'orders.status',
                'restaurants.name as restaurant_name',
                'restaurants.location as restaurant_location',
                'restaurants.phone as restaurant_phone'
            )
            ->whereIn('orders.status', ['Order Received', 'Cooking', 'Order Accepted', 'Order Ready for pickup'])
            ->whereNull('orders.delivery_partner_id')
            ->orderBy('orders.created_at', 'desc')
            ->get();

        return view('Delivery.index', compact('availableOrders', 'todayEarnings', 'totalEarnings'));
    }

    // Accept Order
    public function acceptOrder($orderId)
    {
        $userId = session()->get('userId');
        if (!$userId) return redirect()->route('delivery_login');

        $order = Order::find($orderId);
        if (!$order) return back()->with('error', 'Order not found.');
        if ($order->delivery_partner_id) return back()->with('error', 'Order taken.');

        // 20% Commission
        $deliveryFee = $order->grandTotal * 0.20;

        $order->delivery_partner_id = $userId;
        $order->delivery_fee = $deliveryFee;
        $order->status = 'Driver Assigned'; // Phase 1
        $order->save();

        return redirect()->route('delivery_dashboard')->with('success', 'Order Accepted! Go to restaurant.');
    }

    public function pickedUp($orderId)
    {
        $order = Order::find($orderId);
        if ($order && $order->delivery_partner_id == session('userId')) {
            $order->status = 'Out for Delivery'; // Phase 2
            $order->save();
            return back()->with('success', 'Status updated: Out for Delivery');
        }
        return back()->with('error', 'Update failed');
    }

    public function delivered($orderId)
    {
        $order = Order::find($orderId);
        if ($order && $order->delivery_partner_id == session('userId')) {
            $order->status = 'Order delivered'; // Final Phase
            $order->save();
            return redirect()->route('delivery_dashboard')->with('success', 'Order Delivered! Great job.');
        }
        return back()->with('error', 'Update failed');
    }

    // Update Driver Location (API)
    public function updateLocation(Request $request)
    {
        $userId = session()->get('userId');
        if (!$userId) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
        }

        $lat = $request->input('lat');
        $long = $request->input('long');

        $user = User::find($userId);
        if ($user) {
            $user->current_lat = $lat;
            $user->current_long = $long;
            $user->save();
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
    }
}
