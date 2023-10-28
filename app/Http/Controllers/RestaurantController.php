<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\RestaurantMenu;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;

class RestaurantController extends Controller
{
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
        $resName = Restaurant::where('id',$restaurantId)->select('name')->first();
        $Name = $resName->name;
        $RestaurantPic = $request->file('myFile');
        $restaurant = Restaurant::find($restaurantId);
        $pfpName = time()."_".$Name.".png";
        $RestaurantPic->move(public_path('storage/pfp'),$pfpName);
        $restaurant->restaurant_pfp = $pfpName;
        $restaurant->update();

        // Create menu items 
        foreach ($request->input('name') as $key => $value) {

            $menu = new RestaurantMenu;

            $menu->dish_name = $value;
            $menu->description = $request->input('desc')[$key];
            $menu->price = $request->input('price')[$key];
            $menu->restaurant_id = $restaurantId;

            $menu->save();
        }

        // Upload image files
        // dd($request->file('menuPic'));
        if($request->hasFile('menuPic')) {
        foreach ($request->file('menuPic') as $file) {
            $resId = $menu->restaurant_id;
            $resName = Restaurant::where('id',$resId)->select('name')->first();
            $Name = $resName->name;
            $filename = time() . '_' . $Name.".png";

            $file->move(public_path('storage/Restaurant_menu'), $filename);

            // Associate with menu
            $menuPicture = RestaurantMenu::find($menu->id);
            $menuPicture->dish_pic = $filename;
            // $menuPicture->filename = $filename;
            $menuPicture->update();
        }
    }


        // RestaurantMenu::insert($menus);

        dd("Menu Added Successfully !!!");
        // return back();
        // return back();
    }
}
