<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\RestaurantMenu;
use Illuminate\Http\Request;
use Session;

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
        $isPfp = Restaurant::where('id', $restaurantId)->select('restaurant_pfp', 'name')->first();
        $pfp = $isPfp->restaurant_pfp ?? 0;
        $name = $isPfp->name;
        if ($pfp == 0) {
            $request->validate([
                'myFile' => 'required',
            ]);
        }

        if ($pfp == 0) {
            $ldate = date('Y-m-d H:i:s');
            $resImage = $request->file('myFile');
            if ($request->hasfile('myFile')) {
                $fileName = $resImage->getClientOriginalName();
                $resImage->move(public_path('storage/pfp/'), $ldate . "_" . $name);
                $findRes = Restaurant::find($restaurantId);
                if ($findRes) {
                    $findRes->restaurant_pfp = $ldate . "_" . $name;
                    $findRes->update();
                }
            }
        }
        $menus = [];
        foreach ($request->input('name') as $key => $value) {
            // CHANGES NEEDED
            $menupic = $request->file('menuPic')[$key];
            $menuPicName = $menupic->getClientOriginalName();
            $resImage->move(public_path('storage/menu/'), $ldate . "_" . $menuPicName);
            $menu = [
                'dish_name' => $value,
                'description' => $request->input('desc')[$key],
                'price' => $request->input('price')[$key],
                'restaurant_id' => $restaurantId,
                'dish_pic'=>$menuPicName,
            ];
            $menus[] = $menu;
        }

        RestaurantMenu::insert($menus);

        dd("Menu Added Successfully !!!");
        // return back();
        // return back();
    }
}
