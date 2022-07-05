<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Category;
use App\Models\Cart;
use Auth;



class FrontendController extends Controller
{
    public function index(Request $request)
    {
        if(empty($request->all())){
            $categories = Category::whereNull('parent_id')->get();//pluck('name','id');
            $products = Product::paginate(15);
            return view('frontend.index',compact('products','categories'));

        } else {
            $products = Product::query();
            if (!empty($request->search)) {
                $products = $products->where('name', 'like', '%'.$request->search.'%');
            } 
            if (!empty($request->category)) {
                $products = $products->whereIn('category_id', $request->category);
            } 
            if (!empty($request->subcategory)) {
              $subCategories = $request->subcategory;
                $products->whereHas('subCategories', function($q) use($subCategories){
                    $q->whereIn('name',$subCategories);
                });
            } 
            if (!empty($request->max)){
                $products->where('price', '<=', $request->max);
            }
            if (!empty($request->size)) {
                $products = $products->whereIn('size', $request->size);
            }

            if (!empty($request->min)){
                $products->where('price', '>=', $request->min);
            }

            $products = $products->paginate(15);
            return view('frontend.index',compact('products'));
        }
        //if (!empty($date)) {
         //   $products = $products->whereDate('created_at', \Carbon\Carbon::parse($date));
        //}
    }

    public function filterByCat($cat)
    {
        $categories = Category::whereNull('parent_id')->get();
        $products = Product::where('category_id',$cat)->paginate(15);
        if(count($products)){
            return view('frontend.index',compact('products','categories'));
        } else {
            return redirect()->route('frontend')->with('infoCat','There is no product under this category' );
        }

    }

    public function productDetail($id)
    {
        $product = Product::findOrFail($id);
        //dd(Cart::where('user_id',Auth::id())->where('product_id',$product->id)->exists() );

            return view('frontend.detail',compact('product'));
    }

    // filter by category - subcategory price size
    public function advanceFilter(){
        $categories = Category::whereNull('parent_id')->pluck('name','id');
        $subCategories = Category::whereNotNull('parent_id')->distinct()->get(['name']);
        $sizes = ['S','M','L','XL','XXL'];
        return view('frontend.filter',compact('categories','subCategories','sizes'));
    }

    
}
