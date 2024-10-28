<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    public function index(){

        $total_category = Category::count();
        $total_supplier = Supplier::count();
        $total_product = Product::count();
        $total_customer = Customer::count();
        $total_invoice = Invoice::count();
        $total_purchase = Purchase::count();

        return view('admin.index',compact('total_category','total_supplier','total_product','total_customer','total_invoice','total_purchase'));
    }
}
