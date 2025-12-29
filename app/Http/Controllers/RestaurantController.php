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

        // Get restaurant details
        $getRes = Restaurant::where('owner', $userId)->select('name', 'id', 'location')->first();
        $resId = $getRes->id ?? 0;
        $name = $getRes->name ?? '';
        $location = $getRes->location ?? '';

        // Check if it's an AJAX request
        if (request()->ajax()) {
            $newOrders = DB::table('orders')
                ->select(
                    'orders.id',
                    'orders.status',
                    'orders.user_id',
                    'users.username as userName',
                    'orders.grandTotal',
                    DB::raw('GROUP_CONCAT(order_items.product_id) as product_ids'),
                    DB::raw('GROUP_CONCAT(order_items.quantity) as quantities'),
                    DB::raw('GROUP_CONCAT(restaurant_menus.dish_name) as dish_names'),
                    DB::raw('GROUP_CONCAT(restaurant_menus.price) as prices')
                )
                ->join('users', 'users.id', '=', 'orders.user_id')
                ->join('order_items', 'order_items.order_id', '=', 'orders.id')
                ->join('restaurant_menus', 'restaurant_menus.id', '=', 'order_items.product_id')
                ->where('orders.restaurant_id', $resId)
                ->groupBy('orders.id', 'orders.status', 'orders.user_id', 'users.username', 'orders.grandTotal')
                ->orderByDesc('orders.created_at')
                ->get();

            return response()->json(['orders' => $newOrders]);
        }

        // Fetch orders for initial page load (non-AJAX)
        $initialOrders = DB::table('orders')
            ->select(
                'orders.id',
                'orders.status',
                'orders.user_id',
                'users.username as userName',
                'orders.grandTotal',
                DB::raw('GROUP_CONCAT(order_items.product_id) as product_ids'),
                DB::raw('GROUP_CONCAT(order_items.quantity) as quantities'),
                DB::raw('GROUP_CONCAT(restaurant_menus.dish_name) as dish_names'),
                DB::raw('GROUP_CONCAT(restaurant_menus.price) as prices')
            )
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->join('restaurant_menus', 'restaurant_menus.id', '=', 'order_items.product_id')
            ->where('orders.restaurant_id', $resId)
            ->groupBy('orders.id', 'orders.status', 'orders.user_id', 'users.username', 'orders.grandTotal')
            ->orderByDesc('orders.created_at')
            ->paginate(5);

        // Calculate total earnings
        $totalEarnings = Order::where('restaurant_id', $resId)
            // ->where('status', 'Delivered')
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

        $earningThisMonth = Order::where('restaurant_id', $resId)->sum('grandTotal');
        $totalOrders = Order::where('restaurant_id', $resId)->count();

        return view('Restaurant.index', compact('name', 'location', 'initialOrders', 'resId', 'totalEarnings', 'earningThisMonth', 'totalOrders'))
            ->with('userId', $userId);
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
        $res->location = $request->input('location');
        $res->phone = $request->input('phone');
        $pass = $request->input('pass');
        $cpass = $request->input('cpass');
        $res->owner = session()->get('userId');
        if ($pass == $cpass) {
            $res->password = $pass;
            $res->owner = session()->get('userId');
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



        return back()->with('success', 'Item added successfully !');
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

    public function add_menu()
    {
        $userId = session()->get('userId');
        $getResId = Restaurant::where('owner', $userId)->select('id')->first();
        if ($getResId) {
            $resId = $getResId->id ?? 0;
            session()->put('resId', $resId);
            // session()->put('userId', $res->owner);
            return view('Restaurant.addMenu');
        } else {
            return back();
        }
    }

    public function restaurantMenu()
    {
        $resId = session()->get('resId');
        $userId = session()->get('userId');
        // dd($resId);
        $restaurant = Restaurant::where('owner', $userId)->select('id')->first();

        if ($restaurant) {
            $getDetails = RestaurantMenu::where('restaurant_id', $restaurant->id)->get()->toArray();
        } else {
            $getDetails = []; // If no restaurant is found, return an empty array
        }

        return view('Restaurant.allProducts', compact('getDetails'));
    }

    public function deleteMenu(Request $request, $menuId)
    {
        $menuId = $menuId;
        $item = RestaurantMenu::find($menuId);
        if ($item) {
            $item->delete();
            return back()->with('success', 'Item deleted Successfully !');
        } else {
            return back()->with('error', 'Some Error occured please try again letter');
        }
    }

    public function updateLocation(Request $request)
    {
        $request->validate(['location' => 'required']);
        
        $userId = session()->get('userId');
        $restaurant = Restaurant::where('owner', $userId)->first();

        if ($restaurant) {
            $restaurant->location = $request->location;
            $restaurant->save();
            return back()->with('status', 'Location Updated Successfully!');
        }
        
        return back()->with('error', 'Restaurant not found for this user.');
    }
}
