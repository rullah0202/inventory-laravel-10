<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function CategoryAll(){

        $categories = Category::latest()->get();
        return view('backend.category.category_all',compact('categories'));

    } // End Mehtod 

    public function CategoryAdd(){
     return view('backend.category.category_add');
    } // End Mehtod 


    public function CategoryStore(Request $request){

        // Validate
        $request->validate([
            'name' => 'required|unique:categories'
        ]);

        try {
            Category::insert([
                'name' => $request->name, 
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(), 
            ]);
    
             $notification = array(
                'message' => 'Category Inserted Successfully', 
                'alert-type' => 'success'
            );
    
            return redirect()->route('category.all')->with($notification);
        } catch (\Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
        

    } // End Method 

     public function CategoryEdit($id){

        $category = Category::findOrFail($id);
        return view('backend.category.category_edit',compact('category'));

    }// End Method 


     public function CategoryUpdate(Request $request){

        $category_id = $request->id;

        Category::findOrFail($category_id)->update([
            'name' => $request->name, 
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(), 

        ]);

         $notification = array(
            'message' => 'Category Updated Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('category.all')->with($notification);

    }// End Method 


    public function CategoryDelete($id){

        $product_category_data = Product::where('category_id',$id)->count();

        if($product_category_data > 0){
            $notification = array(
                'message' => 'Category cannot be deleted as it is already used in Products', 
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification );
        } else{
            Category::findOrFail($id)->delete();
            $notification = array(
                'message' => 'Category Deleted Successfully', 
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }

    } // End Method 
}
