<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Cookie;


class CookiesController extends Controller
{
    private string $cookieKey = 'PRODUCT_COOKIE';

    public function getCookies()
    {
        dd(unserialize(Cookie::get($this->cookieKey)));   
    }

    private function buildCartString($id, $qty): string
    {
        $qty =  ($qty <= 0) ? 1 : $qty;

        $cookie_str = Cookie::get($this->cookieKey);

        if($cookie_str) {            
            $cookie_arr = unserialize($cookie_str);
        } 
        $cookie_arr[$id] = $qty;

        return serialize($cookie_arr);
    }

    private function removeProductFromCart($idToRemove)
    {
        $cookie_str = Cookie::get($this->cookieKey);
        if($cookie_str) {
            $cookie_arr = unserialize($cookie_str);
            unset($cookie_arr[$idToRemove]);
            return serialize( $cookie_arr);
        }
    }

    public function addToCart(Request $request)
    {  
        return redirect()->back()
            ->cookie($this->cookieKey,$this->buildCartString($request->product_id, $request->quantity));
                //add time setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
    }

    public function removeFromCart(Request $request)
    {
        return redirect()->back()
            ->cookie($this->cookieKey,$this->removeProductFromCart($request->product_id))
            ->with('danger','Removed from cart successfully ');
    }

    public function remove($id)
    {
        return redirect()->back()
            ->cookie($this->cookieKey,$this->removeProductFromCart($id))
            ->with('danger','Removed from cart successfully ');
    }

    
    public function productInCart()
    {
        $products = []; $totalPrice=0;
        $cookie_str = Cookie::get($this->cookieKey);
        if($cookie_str) {
            $productIDs = array_keys(unserialize($cookie_str));
            $products = Product::whereIn('id', $productIDs)->paginate(15);
            foreach ($products as $product) {
                $totalPrice += $product->price * unserialize($cookie_str)[$product->id];

            }
        } 
        return view('frontend.cart',compact('products','totalPrice'));

    }

    
}
