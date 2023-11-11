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
        return "Cart Page";
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
    
}
