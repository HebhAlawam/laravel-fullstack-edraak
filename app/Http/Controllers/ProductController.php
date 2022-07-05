<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Category; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    public $size = ['S','M','L','XL','XXL'];
    public function index()
    {
        $products = Product::paginate(15);
        return view('admin.product.index',compact('products'));
    }

    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('admin.product.create',compact('categories',))->with('size',['S','M','L','XL','XXL']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'description' => 'required|min:3',
            'price' =>'required|gt:0', 
            'size' =>['nullable','in:S,M,L,XL,XXL'],  
            'image' =>'required|image' ,
            'category' =>'required',
            'subcategory' =>'required'
        ]);
        if(Auth::user()->is_admin == 1){
            $existProduct = Product::where('name' ,$request->name )
                        ->where('category_id',$request->category)
                        ->first();
            if($existProduct){           
                foreach ($existProduct->subCategories as $subcat ){
                    if(in_array($subcat->id,$request->subcategory)){
                    return redirect()->route('product.create')->with('warning','The product cannot be added to the same subcategory ( '.$subcat->name.' ) more than once' );
                    }
                }
            }

            $file =$request->file('image');
            $ext = $file-> getClientOriginalExtension();
            $fileName = $request->name.time().'.'.$ext;
            $file->move('asset/uploads/products',$fileName);

            $product = Product::create([
                'name'=>$request->name,
                'description' => $request->description,
                'price' => $request->price, 
                'size' => $request->size,  
                'category_id' => $request->category,
                'image' => $fileName
            ]);
            $product->subCategories()->attach($request->subcategory);

            return redirect()->route('product.index')->with('success','New Product has been added successfuly');
        } else {
            return redirect()->back()->with(['success'=>'Sorry,you ar not authorized']);
        }
    }

    public function show($id)
    {
        if(Auth::user()->is_admin == 1){
            $product = Product::latest()->findOrFail($id);
            return view('admin.product.show',compact('product'));
        } else {
            return redirect()->back()->with(['success'=>'Sorry,you ar not authorized']);
        }
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $subcategoryId = DB::table('subcategory_product')->where('product_id',$product->id)->pluck('subCategory_id')->first();
        $category = $product->subCategories[0]->category;
        $subCategories = Category::where('parent_id',$category->id)->get();

        $categories = Category::whereNull('parent_id')->get();
        return view('admin.product.edit',compact('product','categories','subCategories','category',))->with('size',['S','M','L','XL','XXL']);
    }

    public function update(Request $request, $id)
    {
         $request->validate([
            'name'=>'required',
            'description' => 'required|min:3',
            'price' =>'required|gt:0', 
            'size' =>['nullable','in:S,M,L,XL,XXL'],  
            'category' =>'required',
            'subcategory' =>'required'
        ]);
         if(Auth::user()->is_admin == 1){
            $product = Product::findOrFail($id);

            if($request->image){
                $path = 'asset/uploads/products/.$product->image'; 
                if($path){  file::delete($path); }
               
                $file =$request->file('image');
                $ext = $file-> getClientOriginalExtension();
                $fileName = time().'.'.$ext;
                $file->move('asset/uploads/products',$fileName);
            } else {
                $fileName= $product->image;
            }
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price; 
            $product->size = $request->size;  
            $product->image = $fileName; 
            $product->update();

            $product->subCategories()->sync($request->subcategory);

            return redirect()->route('product.index')->with('success',' Product has been updated successfuly');
        } else {
            return redirect()->back()->with(['success'=>'Sorry,you ar not authorized']);
        }

    }

    // Delete
    public function delete($id)
    {
        if(Auth::user()->is_admin == 1){

            $product = Product::findOrFail($id);
            $orderItem=orderItem::where('product_id',$id)->exists();
            if($orderItem){
                $product->delete();
                return redirect()->route('product.index')->with('success', 'Product Is Moved To Trash');
            } else {
                $path = 'asset/uploads/products/'.$product->image; 
                if($path){  file::delete($path); }
                $product->forcedelete();
                 return redirect()->back()->with('danger', 'Product Is Deleted Successfully');
            }
        } else {
            return redirect()->back()->with(['success'=>'Sorry,you ar not authorized']);
        }
    }

    //Hard Delete
    public function hardDelete($id)
    {
        $product = Product::onlyTrashed()->where('id',$id)->first();
        $path = 'asset/uploads/products/'.$product->image; 
        //dd($path);
        if($path){  file::delete($path); }
        $product->forcedelete();
         return redirect()->route('product.trash')->with('success', 'Product Is Deleted Successfully');
    }
    //Trash
    public function trash()
    {
        $products = Product::onlyTrashed()->latest()->paginate(4);
         return view('admin.product.trash',compact('products'));
    }
    //Back from trash
    public function backFromTrash ($id)
    {
        $task = Product::onlyTrashed()->where('id',$id)->first()->restore();
         return redirect()->route('product.index')->with('success', 'Product Is Back from trash Successfully');
    }
}
