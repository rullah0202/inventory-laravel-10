<?php

namespace App\Http\Controllers\pos;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function ProductAll(){
        $products = Product::latest()->get();
        return view('backend.product.product_all',compact('products'));
    } // End Method 

    public function ProductAdd(){
        $supplier = Supplier::all();
        $category = Category::all();
        $unit = Unit::all();
        return view('backend.product.product_add',compact('supplier','category','unit'));
    } // End Method 


    public function ProductStore(Request $request){

        Product::insert([

            'name' => $request->name,
            'supplier_id' => $request->supplier_id,
            'unit_id' => $request->unit_id,
            'category_id' => $request->category_id,
            'quantity' => '0',
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(), 
        ]);

        $notification = array(
            'message' => 'Product Inserted Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('product.all')->with($notification); 
    } // End Method 


    public function ProductEdit($id){
        $supplier = Supplier::all();
        $category = Category::all();
        $unit = Unit::all();
        $product = Product::findOrFail($id);
        return view('backend.product.product_edit',compact('product','supplier','category','unit'));
    } // End Method  

    public function ProductUpdate(Request $request){

        $product_id = $request->id;

         Product::findOrFail($product_id)->update([

            'name' => $request->name,
            'supplier_id' => $request->supplier_id,
            'unit_id' => $request->unit_id,
            'category_id' => $request->category_id, 
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(), 
        ]);

        $notification = array(
            'message' => 'Product Updated Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('product.all')->with($notification); 


    } // End Method 

    public function ProductDelete($id){

        $product_purcase_data = Purchase::where('product_id',$id)->count();

        if($product_purcase_data> 0){
            $notification = array(
                'message' => 'Product cannot be deleted as it is already used in Purchase', 
                'alert-type' => 'error'
            );
    
            return redirect()->back()->with($notification);
            
        } else{
            Product::findOrFail($id)->delete();
        
            $notification = array(
                 'message' => 'Product Deleted Successfully', 
                 'alert-type' => 'success'
             );
     
             return redirect()->back()->with($notification);
        }


  
      } // End Method 
}
