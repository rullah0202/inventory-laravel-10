<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class SupplierController extends Controller
{
    public function SupplierAll(){
        // $suppliers = Supplier::all();
        $suppliers = Supplier::latest()->get();
        return view('backend.supplier.supplier_all',compact('suppliers'));
    } // End Method 


    public function SupplierAdd(){
     return view('backend.supplier.supplier_add');
    } // End Method 


    public function SupplierStore(Request $request){

        // Validate
        $request->validate([
            'name' => 'required|unique:suppliers'
        ]);

        try {
            Supplier::insert([
                'name' => $request->name,
                'mobile_no' => $request->mobile_no,
                'email' => $request->email,
                'address' => $request->address,
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(), 
            ]);
    
             $notification = array(
                'message' => 'Supplier Inserted Successfully', 
                'alert-type' => 'success'
            );
    
            return redirect()->route('supplier.all')->with($notification);
        } catch (\Exception $e) {
            $notification = array(
                'message' => $e->getMessage(), 
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }


    } // End Method 


    public function SupplierEdit($id){

        $supplier = Supplier::findOrFail($id);
        return view('backend.supplier.supplier_edit',compact('supplier'));

    } // End Method 

    public function SupplierUpdate(Request $request){

        $supplier_id = $request->id;

        Supplier::findOrFail($supplier_id)->update([
            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'email' => $request->email,
            'address' => $request->address,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(), 
        ]);

         $notification = array(
            'message' => 'Supplier Updated Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('supplier.all')->with($notification);

    } // End Method 


    public function SupplierDelete($id){

        $product_supplier_data = Product::where('supplier_id',$id)->count();

        if($product_supplier_data > 0){
            $notification = array(
                'message' => 'Supplier cannot be deleted as it is already used in Products', 
                'alert-type' => 'error'
            );
    
            return redirect()->back()->with($notification);
        } else{
            Supplier::findOrFail($id)->delete();
      
            $notification = array(
                 'message' => 'Supplier Deleted Successfully', 
                 'alert-type' => 'success'
             );
     
             return redirect()->back()->with($notification);
        }

    } // End Method 
}
