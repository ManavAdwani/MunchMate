<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\RestaurantMenu;
use Illuminate\Http\Request;
use session;

class CartController extends Controller
{
    public function index()
    {
        $userId = session()->get('userId');
        if($userId){
            $products = Cart::where('user_id', $userId)->join('users', 'users.id', '=', 'carts.user_id')->join('restaurant_menus', 'restaurant_menus.id', '=', 'carts.product_id')->select('carts.id as cartId', 'restaurant_menus.dish_name as dish_name', 'restaurant_menus.description as dish_desc', 'restaurant_menus.price as price', 'restaurant_menus.dish_pic as dish_pic', 'carts.quantity as qty')->get();
            if(!empty($products)){
                $resId = Cart::where('user_id', $userId)->join('users', 'users.id', '=', 'carts.user_id')->join('restaurant_menus', 'restaurant_menus.id', '=', 'carts.product_id')->select('carts.restaurant_id as ResId')->first();
                if(!empty($resId)){
                    $restaurant_id = $resId->ResId;
                    $totalPrice = 0;
                    foreach ($products as $product) {
                        $totalPrice += $product->qty * $product->price;
                    }
                    $grandTotal = $totalPrice + 45;
                    $totalCount = Cart::where('user_id', $userId)->join('users', 'users.id', '=', 'carts.user_id')->join('restaurant_menus', 'restaurant_menus.id', '=', 'carts.product_id')->select('restaurant_menus.dish_name as dish_name', 'restaurant_menus.description as dish_desc', 'restaurant_menus.price as price', 'restaurant_menus.dish_pic as dish_pic')->count();
                    return view('Cart.cart', compact('products', 'totalCount', 'totalPrice', 'grandTotal','userId','restaurant_id'));
                }else{
                    return view('Cart.emptyCart');
                }
            }
            else{
                return view('Cart.emptyCart');
            }

           
        }
        else{
            return view('Sign in.sign_in');
        }
       
    }


    public function addProduct($id)
    {
        $userId = session()->get('userId');
        $productId = $id;

        // Get details of the selected product
        $getDetails = RestaurantMenu::where('id', $productId)->select('price', 'restaurant_id')->first();
        $price = $getDetails->price;
        $resId = $getDetails->restaurant_id;

        // Check if the user has any items in the cart
        $userCart = Cart::where('user_id', $userId)->first();

        if (!$userCart) {
            // User's cart is empty, add a new item
            $cart = new Cart();
            $cart->user_id = $userId;
            $cart->product_id = $productId;
            $cart->restaurant_id = $resId;
            $cart->quantity = 1;
            $cart->price = $price;
            $cart->save();

            return back();
        }

        // Check if the product is already in the user's cart
        $isAlreadyThere = Cart::where('product_id', $productId)->where('user_id', $userId)->first();

        if ($isAlreadyThere) {
            // Product is already in the cart, update quantity
            $isAlreadyThere->quantity += 1;
            $isAlreadyThere->save();

            return back();
        }

        // Product is not in the cart, check if it belongs to the same restaurant
        if ($userCart->restaurant_id == $resId) {
            // Product belongs to the same restaurant, add a new item
            $cart = new Cart();
            $cart->user_id = $userId;
            $cart->product_id = $productId;
            $cart->restaurant_id = $resId;
            $cart->quantity = 1;
            $cart->price = $price;
            $cart->save();

            return back();
        } else {
            // Product does not belong to the same restaurant, handle this case as needed
            echo '<script>
            var result = confirm("Adding this product will clear your current cart. Do you want to proceed?");
            if (result) {
                alert("Done");
                // window.location.href = "/clear-cart-and-add-product/' . $productId . '";
            }
          </script>';
        }
    }

    public function updateQuantity(Request $request)
    {
        // dd($request->id);
        try {
            $cartId = $request->id;
            $qty = $request->qty;

            $findProduct = Cart::find($cartId);
            if (!$findProduct) {
                return response()->json(['error' => 'Product not found.'], 404);
            }

            $findProduct->quantity = $qty;
            $findProduct->update();

            return response()->json(['message' => 'Cart Updated']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
