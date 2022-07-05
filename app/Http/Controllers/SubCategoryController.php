<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subCategories = Category::whereNotNull('parent_id')->latest()->paginate(10);
        return view('admin.subCategory.index',compact('subCategories'));
    }

    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('admin.subCategory.create',compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required',
                        Rule::unique('categories')->where(fn ($query) => $query->where('parent_id', $request->category))],
            'category'=>'required',
        ]);
        if(Auth::user()->is_admin == 1){
            $subcategory=new Category();
            $subcategory->name = $request->name;
            $subcategory->parent_id = $request->category;
            $subcategory->save();

            return redirect()->route('subCategory.index')->with('success','New SubCategory has been added successfuly');
        } else {
            return redirect()->back()->with(['success'=>'Sorry,you ar not authorized']);
        }
    }
    public function edit($id)
    {
        $subCategory = Category::findOrFail($id);
        $categories = Category::whereNull('parent_id')->get();
        return view('admin.subCategory.edit', compact('subCategory','categories'));
    }

    public function update(Request $request,$id)
    {
        if(Auth::user()->is_admin == 1){
            $request->validate([
                'name' => ['required',
                            Rule::unique('categories')->where(fn ($query) 
                                => $query->where('parent_id', $request->category))
                                ->ignore(request('name'),'name')],
                'category'=>'required',
            ]);

            $subcategory = Category::findOrFail($id);
            $subcategory->name = $request->name;
            $subcategory->parent_id = $request->category;
            $subcategory->update();
            return redirect()->route('subCategory.index')->with(['success'=>'SubCategory has been updated']);
            
        }   else {
            return redirect()->back()->with(['success'=>'Sorry,you ar not authorized']);
        }
    }


    //soft Delete
    public function softdelete($id)
    {
        $subCategory = Category::findOrFail($id)->delete();
         return redirect()->route('subCategory.index')->with('success', 'SubCategory Is Moved To Trash');
    }
    //Hard Delete
    public function hardDelete($id)
    {
        $subCategory = Category::onlyTrashed()->where('id',$id)->forcedelete();
         return redirect()->route('subCategory.trash')->with('success', 'SubCategory Is Deleted Successfully');
    }
    //Trash
    public function trash()
    {
        $subCategories = Category::onlyTrashed()->latest()->paginate(4);
         return view('admin.subCategory.trash',compact('subCategories'));
    }
    //Back from trash
    public function backFromTrash ($id)
    {
        $task = Category::onlyTrashed()->where('id',$id)->first()->restore();
         return redirect()->route('subCategory.index')->with('success', 'SubCategory Is Back from trash Successfully');
    }

    public function subCat(Request $request)
        {
            $parent_id = $request->cat_id;
            $subcategories = Category::where('id',$parent_id)
                ->with('subcategories')
                ->get();
            return response()->json([
                'subcategories' => $subcategories
            ]);
        }
}
