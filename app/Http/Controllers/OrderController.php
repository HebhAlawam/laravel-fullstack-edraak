<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;

use App\Models\Product;
use App\Models\Cart;



 
class OrderController extends Controller
{
    public function test()
    {
        $orderItem = new OrderItem();            
        $orderItem->product_id = 1;
        $orderItem->product_price = 1;
        $orderItem->product_qty = 1;
        $orderItem->order_id = 1;                        
        $orderItem->save();
        dd('done');

    }
    public function allOrder()
    {
        $orders= Order::orderBy('id','DESC')->paginate(15); 
        return view('admin.order.all', compact('orders')); 
    }

    public function customerOrder()
    {
        $orders= Order::orderBy('id','DESC')->where('user_id', Auth::id())->paginate(15); 
        return view('frontend.order.all', compact('orders')); 
    }

    public function orderDetails($id)
    {
        $order = Order::findOrFail($id);
        if($order->user_id == Auth::id()){

            return view('frontend.order.view', compact('order'));
        } else {
            abort('404');
        }
    }

    public function orderView($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.view', compact('order'));

        
        
    }
    public function checkoutPage()
    {
        $user = Order::select('address1','address2','city','country','state','postalCode')->where('user_id',Auth::id())->first();
        return view('frontend.checkout',compact('user')); 
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'address1'=>'required',
            'city'=>'required',
            'country'=>'required',
            'postalCode'=>'required',
            'payment'=>'required',
        ]);

        $cartProducts = Cart::where('user_id',Auth::id())->get();

        //cart not empty
        if (!$cartProducts->isEmpty()){ 
            //make new order
            $order = new Order();
            $order->user_id=Auth::id();
            $order->address1=$request->address1;
            $order->address2=$request->address2;
            $order->city=$request->city;
            $order->state=$request->state;
            $order->country=$request->country;
            $order->postalCode=$request->postalCode;
            $order->payment_method=$request->payment;
            $order->totalPrice = 0;
            $order->save();

            //save cart products to order items and delete them from cart
            $totalPrice = 0;
            foreach ($cartProducts as $cartProduct) {
                $orderItem = new OrderItem();            
                $orderItem->product_id = $cartProduct->product_id;
                $orderItem->product_price = $cartProduct->product->price;
                $orderItem->product_qty = $cartProduct->product_qty;
                $orderItem->order_id  = $order->id;                      
                $orderItem->save();
                $totalPrice += $cartProduct->product->price * $cartProduct->product_qty;
                $cartProduct->delete();
            }
            //update total price
            $order->update(['totalPrice' => $totalPrice] );  
            return redirect()->route('customer.order')->with('success', 'Your order added successfuly');

        } else {
            abort('404', 'Your cart is empty');
        }
    }

    public function status(Request $request)
    {
        $order = Order::find($request->order_id);     
        $order->update(['status' => $request->status] );
        return redirect()->back();
    }

    
}
