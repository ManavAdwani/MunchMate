<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Restaurant;
use App\Models\RestaurantMenu;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Http\Request;
use Session;
use DB;
use Carbon\Carbon;

class RestaurantController extends Controller
{
    public function index()
    {
        $userId = session()->get('userId');
        $getName = User::where('id', $userId)->select('username')->first();
        $name = $getName->username;
        $getResId = Restaurant::where('owner', $userId)->select('name', 'id')->first();
        $resId = $getResId->id;


        // Check if it's an AJAX request
        if (request()->ajax()) {
            // If it's an AJAX request, fetch new orders and return JSON response
            $newOrders = Order::where('restaurant_id', $resId)->get();
            $allOrderedProducts = [];

            foreach ($newOrders as $order) {
                $userCart = Cart::where('user_id', $order->user_id)
                    ->where('restaurant_id', $resId)
                    ->pluck('product_id')
                    ->toArray();
                $userDetails = DB::table('users')
                    ->where('id', $order->user_id)
                    ->select('username') // Change this based on your actual column name
                    ->first();
                $userName = $userDetails->username; // Change this based on your actual column name

                // Retrieve products from the restaurant_menus table based on the product_id
                $orderedProducts = RestaurantMenu::whereIn('id', $userCart)->get();
                $orderTotalPrice = 0;

                // Calculate total price for each ordered product
                foreach ($orderedProducts as $product) {
                    $quantity = Cart::where('user_id', $order->user_id)
                        ->where('restaurant_id', $resId)
                        ->where('product_id', $product->id)
                        ->value('quantity');

                    // Assuming your RestaurantMenu model has a 'price' attribute
                    $totalPrice = $product->price * $quantity;

                    // Add the total price for the current product to the order's total
                    $orderTotalPrice += $totalPrice;

                    // You can use $totalPrice as needed for each product
                    $product->totalPrice = $totalPrice;
                }

                // Store ordered products and total price in an array
                $allOrderedProducts[] = [
                    'order' => $order,
                    'userName' => $userName,
                    'orderedProducts' => $orderedProducts,
                    'orderTotalPrice' => $orderTotalPrice,
                ];
                // dd($allOrderedProducts);
            }
            return response()->json(['newOrders' => $newOrders]);
        }

        // If it's not an AJAX request, render the initial view with existing orders
        $initialOrders = Order::where('restaurant_id', $resId)->paginate(5);
        $allOrderedProducts = [];

        foreach ($initialOrders as $order) {
            $userCart = Cart::where('user_id', $order->user_id)
                ->where('restaurant_id', $resId)
                ->pluck('product_id')
                ->toArray();
            $userDetails = DB::table('users')
                ->where('id', $order->user_id)
                ->select('username') // Change this based on your actual column name
                ->first();
            $userName = $userDetails->username; // Change this based on your actual column name

            // Retrieve products from the restaurant_menus table based on the product_id
            $orderedProducts = RestaurantMenu::whereIn('id', $userCart)->get();
            $orderTotalPrice = 0;
            $quantities = [];

            // Calculate total price for each ordered product
            foreach ($orderedProducts as $product) {
                $quantity = Cart::where('user_id', $order->user_id)
                    ->where('restaurant_id', $resId)
                    ->where('product_id', $product->id)
                    ->value('quantity');

                // Assuming your RestaurantMenu model has a 'price' attribute
                $totalPrice = $product->price * $quantity;
                $quantities[$product->id] = $quantity ?? 0;
                // Add the total price for the current product to the order's total
                $orderTotalPrice += $totalPrice;

                // You can use $totalPrice as needed for each product
                $product->totalPrice = $totalPrice;
            }

            // Store ordered products and total price in an array
            $allOrderedProducts[] = [
                'order' => $order,
                'userName' => $userName,
                'orderedProducts' => $orderedProducts,
                'orderTotalPrice' => $orderTotalPrice,
                'quantities' => $quantities
            ];
        }
        // dd($allOrderedProducts);

        $totalEarnings = Order::where('restaurant_id', $resId)
            ->where('status', 'Delivered')
            ->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(grandTotal) as total_earning')
            )
            ->groupBy('year', 'month')
            ->get();
        $totalEarnings = $totalEarnings->map(function ($earning) {
            $earning->month = Carbon::createFromDate(null, $earning->month, null)->monthName;
            return $earning;
        });

        $earningThisMonth = Order::where('restaurant_id', $resId)
            ->where('status', 'Delivered')
            ->sum('grandTotal');

        $totalOrders =  Order::where('restaurant_id', $resId)->count();
        return view('Restaurant.index', compact('name', 'allOrderedProducts', 'resId', 'totalEarnings','earningThisMonth','totalOrders'))->with('userId', $userId);
    }


    public function addRestaurant()
    {
        return view('Restaurant.addRestaurant');
    }
    public function saveRestaurant(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:restaurants,email',
            'phone' => 'required',
            'pass' => 'required',
            'cpass' => 'required'
        ]);

        $res = new Restaurant;
        $res->name = $request->input('name');
        $res->email = $request->input('email');
        $res->phone = $request->input('phone');
        $pass = $request->input('pass');
        $cpass = $request->input('cpass');
        $res->owner = session()->get('userId');
        if ($pass == $cpass) {
            $res->password = $pass;
            $res->owner = 1;
            $res->save();
            session()->put('userId', $res->owner);
            session()->put('resId', $res->id);
            return redirect('addMenu');
        }
    }

    public function loginRes()
    {
        return view('Restaurant.restaurant_login');
    }

    public function restaurant_login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'phone' => 'required',
            'pass' => 'required'
        ]);

        $findRestaurant = Restaurant::where('email', $request->input('email'))->select('password', 'phone')->first();
        if ($findRestaurant) {
            $actualPhone = $findRestaurant->phone;
            $actualPass = $findRestaurant->password;
            $phone = $request->input('phone');
            $pass = $request->input('pass');
            if ($phone == $actualPhone) {
                if ($pass == $actualPass) {
                    $getResId = Restaurant::where('email', $request->input('email'))->select('id')->first();
                    $isMenu = RestaurantMenu::where('restaurant_id', $getResId->id)->exists();
                    if ($isMenu) {
                        session()->put('resId', $getResId->id);
                        return back()->with('message', 'Welcome Back');
                    } else {
                        session()->put('resId', $getResId->id);
                        return view('Restaurant.addMenu');
                    }
                } else {
                    return back()->with('message', 'Wrong Password');
                }
            } else {
                return back()->with('message', 'Wrong Phone Number');
            }
        } else {
            return back()->with('message', 'Restaurant with these details dont exists please register first');
        }
    }

    public function saveMenu(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'price' => 'required'
        ]);
        $restaurantId = session()->get('resId');
        $resName = Restaurant::where('id', $restaurantId)->select('name')->first();
        $Name = $resName->name;
        if ($request->file('myFile')) {
            $RestaurantPic = $request->file('myFile');
            $restaurant = Restaurant::find($restaurantId);
            $pfpName = time() . "_" . $Name . ".png";
            $RestaurantPic->move(public_path('storage/pfp'), $pfpName);
            $restaurant->restaurant_pfp = $pfpName;
            $restaurant->update();
        }
        // Create menu items 
        // Save menus to get IDs 
        foreach ($request->input('name') as $key => $value) {
            $menu = new RestaurantMenu;
            $menu->dish_name = $value;
            $menu->description = $request->input('desc')[$key];
            $menu->price = $request->input('price')[$key];
            $menu->restaurant_id = $restaurantId;
            $menu->save();

            // Upload dish images
            if ($request->hasFile('menuPic')) {
                if ($request->file('menuPic')[$key]) {
                    $file = $request->file('menuPic')[$key];

                    // Generate unique file name
                    $filename = time() . "_" . $Name . "_" . $value . ".png";

                    // Upload image
                    $file->move(public_path('dishes'), $filename);

                    // Get saved menu
                    $menu = RestaurantMenu::find($menu->id);

                    // Update dish_pic filename
                    $menu->dish_pic = $filename;
                    $menu->update();
                }
            }
        }

        dd("Menu Added Successfully");

        // return redirect()
        //     ->with('success', 'Menu uploaded!');
        // return back();
        // return back();
    }

    public function showMenu(Request $request, $id)
    {
        $menu = RestaurantMenu::join('restaurants', 'restaurants.id', '=', 'restaurant_menus.restaurant_id')->where('restaurant_id', $id)->select('restaurants.name', 'restaurants.email', 'restaurants.phone', 'restaurants.restaurant_pfp', 'restaurant_menus.dish_name', 'restaurant_menus.description', 'restaurant_menus.price', 'restaurant_menus.dish_pic', 'restaurant_menus.id as menu_id')->get();
        $name = Restaurant::where('id', $id)->select('name', 'restaurant_pfp')->first();
        $resName = $name->name;
        $resPfp = $name->restaurant_pfp;
        return view('Menu/menuPage', compact('menu', 'resName', 'resPfp'));
    }

    public function changeOrderStatus(Request $request, $orderId, $orderStatus)
    {
        $changeStatus = Order::find($orderId);
        // dd($orderStatus);
        if ($orderStatus == 2) {
            $changeStatus->status = "Order Accepted";
        }
        if ($orderStatus == 3) {
            $changeStatus->status = "Order Ready for pickup";
        }
        if ($orderStatus == 4) {
            $changeStatus->status = "Order Picked";
        }
        if ($orderStatus == 5) {
            $changeStatus->status = "Order delivered";
        }
        $changeStatus->update();
        return back()->with('status', 'Order Status Changed Successfully');
    }
}
