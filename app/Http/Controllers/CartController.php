<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;


use Illuminate\Support\Facades\Cookie;


class CartController extends Controller
{
        public function itemsInCart()
    {
        $cartProducts = Cart::where('user_id',Auth::id())->get();
        return view('frontend.cart',compact('cartProducts'));
    }

    public function addToCart(Request $request)
    {
        $cart = Cart::where('user_id', Auth::id())->where('product_id',$request->product_id)->exists();

        if ($cart){
            return response()->json(['message' => "This product is already exist in cart"]);
        } else {
            $product = Product::where('id',$request->product_id)->pluck('name')->toArray();

            if($product){
                $qty =  ($request->quantity <= 0) ? 1 : $request->quantity;

                $cartItem = Cart::create([
                    'user_id'=>Auth::id(),
                    'product_qty' => $qty,
                    'product_id' => $request->product_id,

                ]);
                
                return response()->json(['message' => $product[0]. " Add to cart successfully"]);   
            } else {
                abort(404, 'This product is not exist.');
            }
        }   
    }
    public function updateQuantity(Request $request)
    {
        $cart = Cart::where('user_id', Auth::id())->where('product_id',$request->product_id)->first();
        if($cart){
            $cart->product_qty = $request->quantity;
            $cart->save();

            return response()->json(['message' => 'Product quantity in cart updated successfully.']);
        } else {
            abort(404, 'This product is not exist.');
        }
    }

    

    public function removeFromCart(Request $request)
    {
        $cart = Cart::where('user_id', Auth::id())->where('product_id',$request->product_id)->first();
        if ($cart){
            $cart->delete();
            return response()->json(['message' =>" Remove from cart successfully"]);   

        } else {
            abort(404, 'This product is not exist in cart.');
        }
    }

    public function removeCart($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return redirect()->back()->with('danger','Removed from cart successfully ');
    }

}
