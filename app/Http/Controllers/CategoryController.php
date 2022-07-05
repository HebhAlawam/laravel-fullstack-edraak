<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

 
class CategoryController extends Controller
{

    public function index()
    {
        
        $categories = Category::whereNull('parent_id')->latest()->paginate(10);
        return view('admin.category.index',compact('categories'));
        
    }    

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        if(Auth::user()->is_admin == 1){
            $request->validate([
                'name'=>'required|Unique:categories',
            ]);
            $category=new Category();
            $category->name=$request->name;
            $category->parent_id=NULL;
            $category->save();
            return redirect()->route('category.index')->with('success','New Category has been added successfuly');
        } else {
            return redirect()->back()->with(['success'=>'Sorry,you ar not authorized']);
        }
    }


    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit',compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>['required',Rule::unique('categories')->ignore(request('name'),'name')],
        ]);
        if(Auth::user()->is_admin == 1){
            $category = Category::findOrFail($id);
            $category->name=$request->name;
            $category->parent_id = NULL;
            $category->update();
            return redirect()->route('category.index')->with(['success'=>'Category has been updated successfuly']);
        } else {
            return redirect()->back()->with(['success'=>'Sorry,you ar not authorized']);
        }
    }

    public function destroy($id)
    {
        if(Auth::user()->is_admin == 1){
            $category = Category::findOrFail($id);
            $subCategories=Category::where('parent_id',$id)->exists();
            if($subCategories){
                return redirect()->route('category.index')->with('warning', 'You have to delete all subCategories under this Category');

            } else {
                $category->forcedelete();
                return redirect()->route('category.index')->with('success', 'Category Is Deleted Successfully');
            }
        } else {
            return redirect()->back()->with(['success'=>'Sorry,you ar not authorized']);
        }


        
    }
    
}
