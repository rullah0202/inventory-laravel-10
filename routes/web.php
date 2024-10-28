<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\Pos\CategoryController;
use App\Http\Controllers\Pos\CustomerController;
use App\Http\Controllers\pos\DefaultController;
use App\Http\Controllers\pos\InvoiceController;
use App\Http\Controllers\pos\ProductController;
use App\Http\Controllers\Pos\PurchaseController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Pos\SupplierController;
use App\Http\Controllers\Pos\UnitController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Pos\StockController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminHomeController::class,'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::controller(RoleController::class)->group(function () {

        // Permission All Route 
        Route::get('/all/permission', 'AllPermission')->name('all.permission');
        Route::get('/add/permission', 'AddPermission')->name('add.permission');
        Route::post('/store/permission' , 'StorePermission')->name('store.permission');

        Route::get('/edit/permission/{id}' , 'EditPermission')->name('edit.permission');
        Route::post('/update/permission' , 'UpdatePermission')->name('update.permission');
        Route::get('/delete/permission/{id}' , 'DeletePermission')->name('delete.permission');

        // Roles All Route 

        Route::get('/all/roles' , 'AllRoles')->name('all.roles');
        Route::get('/add/roles' , 'AddRoles')->name('add.roles');
        Route::post('/store/roles' , 'StoreRoles')->name('store.roles');

        Route::get('/edit/roles/{id}' , 'EditRoles')->name('edit.roles');
        Route::post('/update/roles' , 'UpdateRoles')->name('update.roles');
        Route::get('/delete/roles/{id}' , 'DeleteRoles')->name('delete.roles');

        // add role permission 
        Route::get('/add/roles/permission' , 'AddRolesPermission')->name('add.roles.permission');
        Route::post('/role/permission/store' , 'RolePermissionStore')->name('role.permission.store');

        Route::get('/all/roles/permission' , 'AllRolesPermission')->name('all.roles.permission');
        Route::get('/admin/edit/roles/{id}' , 'AdminRolesEdit')->name('admin.edit.roles');
        Route::post('/admin/roles/update/{id}' , 'AdminRolesUpdate')->name('admin.roles.update');
        Route::get('/admin/delete/roles/{id}' , 'AdminRolesDelete')->name('admin.delete.roles');
    });


   
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin All Route 
Route::middleware('auth')->group(function () {
    Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/logout', 'destroy')->name('admin.logout');
    Route::get('/admin/profile',  'Profile')->name('admin.profile');
    Route::get('/edit/profile',  'EditProfile')->name('edit.profile');
    Route::post('/store/profile',  'StoreProfile')->name('store.profile');

    Route::get('/change/password',  'ChangePassword')->name('change.password');
    Route::post('/update/password',  'UpdatePassword')->name('update.password');

    Route::get('/all/admin' , 'AllAdmin')->name('all.admin');
    Route::get('/add/admin' , 'AddAdmin')->name('add.admin');
    Route::post('/admin/user/store' , 'AdminUserStore')->name('admin.user.store');
    Route::get('/edit/admin/role/{id}' , 'EditAdminRole')->name('edit.admin.role');
    Route::post('/admin/user/update/{id}' , 'AdminUserUpdate')->name('admin.user.update');
    Route::get('/delete/admin/role/{id}' , 'DeleteAdminRole')->name('delete.admin.role');
    });
});

// Supplier All Route 
Route::middleware('auth')->group(function () {
    Route::controller(SupplierController::class)->group(function () {
        Route::get('/supplier/all', 'SupplierAll')->name('supplier.all'); 
        Route::get('/supplier/add', 'SupplierAdd')->name('supplier.add'); 
        Route::post('/supplier/store', 'SupplierStore')->name('supplier.store');
        Route::get('/supplier/edit/{id}', 'SupplierEdit')->name('supplier.edit'); 
        Route::post('/supplier/update', 'SupplierUpdate')->name('supplier.update');
        Route::get('/supplier/delete/{id}', 'SupplierDelete')->name('supplier.delete');
    });
});

// Customer All Route 
Route::middleware('auth')->group(function () {
    Route::controller(CustomerController::class)->group(function () {
        Route::get('/customer/all', 'CustomerAll')->name('customer.all'); 
        Route::get('/customer/add', 'CustomerAdd')->name('customer.add'); 
        Route::post('/customer/store', 'CustomerStore')->name('customer.store');
        Route::get('/customer/edit/{id}', 'CustomerEdit')->name('customer.edit'); 
        Route::post('/customer/update', 'CustomerUpdate')->name('customer.update');
        Route::get('/customer/delete/{id}', 'CustomerDelete')->name('customer.delete');

        Route::get('/credit/customer', 'CreditCustomer')->name('credit.customer');
        Route::get('/credit/customer/print/pdf', 'CreditCustomerPrintPdf')->name('credit.customer.print.pdf');

        Route::get('/customer/edit/invoice/{invoice_id}', 'CustomerEditInvoice')->name('customer.edit.invoice');
        Route::post('/customer/update/invoice/{invoice_id}', 'CustomerUpdateInvoice')->name('customer.update.invoice');

        Route::get('/customer/invoice/details/{invoice_id}', 'CustomerInvoiceDetails')->name('customer.invoice.details.pdf');

        Route::get('/paid/customer', 'PaidCustomer')->name('paid.customer');
        Route::get('/paid/customer/print/pdf', 'PaidCustomerPrintPdf')->name('paid.customer.print.pdf');

        Route::get('/customer/wise/report', 'CustomerWiseReport')->name('customer.wise.report');
        Route::get('/customer/wise/credit/report', 'CustomerWiseCreditReport')->name('customer.wise.credit.report');
        Route::get('/customer/wise/paid/report', 'CustomerWisePaidReport')->name('customer.wise.paid.report');
    });
});

// Category All Route 
Route::middleware('auth')->group(function () {
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category/all', 'CategoryAll')->name('category.all'); 
        Route::get('/category/add', 'CategoryAdd')->name('category.add');
        Route::post('/category/store', 'CategoryStore')->name('category.store');
        Route::get('/category/edit/{id}', 'CategoryEdit')->name('category.edit');
        Route::post('/category/update', 'CategoryUpdate')->name('category.update');
        Route::get('/category/delete/{id}', 'CategoryDelete')->name('category.delete');
    });
});

// Unit All Route 
Route::middleware('auth')->group(function () {
    Route::controller(UnitController::class)->group(function () {
        Route::get('/unit/all', 'UnitAll')->name('unit.all'); 
        Route::get('/unit/add', 'UnitAdd')->name('unit.add');
        Route::post('/unit/store', 'UnitStore')->name('unit.store');
        Route::get('/unit/edit/{id}', 'UnitEdit')->name('unit.edit');
        Route::post('/unit/update', 'UnitUpdate')->name('unit.update');
        Route::get('/unit/delete/{id}', 'UnitDelete')->name('unit.delete');
    });
});

// Product All Route 
Route::middleware('auth')->group(function () {
    Route::controller(ProductController::class)->group(function () {
        Route::get('/product/all', 'ProductAll')->name('product.all'); 
        Route::get('/product/add', 'ProductAdd')->name('product.add');
        Route::post('/product/store', 'ProductStore')->name('product.store');
        Route::get('/product/edit/{id}', 'ProductEdit')->name('product.edit');
        Route::post('/product/update', 'ProductUpdate')->name('product.update');
        Route::get('/product/delete/{id}', 'ProductDelete')->name('product.delete');
    });
});

// Purchase All Route 
Route::middleware('auth')->group(function () {
    Route::controller(PurchaseController::class)->group(function () {
        Route::get('/purchase/all', 'PurchaseAll')->name('purchase.all'); 
        Route::get('/purchase/add', 'PurchaseAdd')->name('purchase.add');
        Route::post('/purchase/store', 'PurchaseStore')->name('purchase.store');
        Route::get('/purchase/delete/{id}', 'PurchaseDelete')->name('purchase.delete');
        Route::get('/purchase/pending', 'PurchasePending')->name('purchase.pending');
        Route::get('/purchase/approve/{id}', 'PurchaseApprove')->name('purchase.approve');
    });
});

// Invoice All Route 
Route::middleware('auth')->group(function () {
    Route::controller(InvoiceController::class)->group(function () {
        Route::get('/invoice/all', 'InvoiceAll')->name('invoice.all'); 
        Route::get('/invoice/add', 'InvoiceAdd')->name('invoice.add');
        Route::post('/invoice/store', 'InvoiceStore')->name('invoice.store');

        Route::get('/invoice/invoice-delete/{id}', 'invoice_delete')->name('invoice_delete');
        Route::get('/invoice/invoice-approve/{id}', 'invoice_approve')->name('invoice_approve');
        Route::post('/invoice/invoice-approve-store/{id}', 'invoice_approve_store')->name('invoice_approve_store');

        Route::get('/invoice/invoice-print/{id}', 'invoice_print')->name('invoice_print');

        Route::get('/invoice/date-wise', 'DailyInvoiceReport')->name('daily.invoice.report');
        Route::get('/invoice/date-wise-pdf', 'DailyInvoicePdf')->name('daily.invoice.pdf');
    });
});

// Stock All Route 
Route::middleware('auth')->group(function () {
    Route::controller(StockController::class)->group(function () {
        Route::get('/stock/report', 'StockReport')->name('stock.report');
        Route::get('/stock/report/pdf', 'StockReportPdf')->name('stock.report.pdf'); 

        Route::get('/stock/supplier/wise', 'StockSupplierWise')->name('stock.supplier.wise'); 
        Route::get('/supplier/wise/pdf', 'SupplierWisePdf')->name('supplier.wise.pdf');
        Route::get('/product/wise/pdf', 'ProductWisePdf')->name('product.wise.pdf');
    });
});


// Default All Route 
Route::middleware('auth')->group(function () {
    Route::controller(DefaultController::class)->group(function () {
        Route::get('/get-category', 'GetCategory')->name('get-category'); 
        Route::get('/get-supplier', 'GetSupplier')->name('get-supplier'); 
        Route::get('/get-product', 'GetProduct')->name('get-product'); 
        Route::get('/check-product', 'GetStock')->name('check-product-stock'); 
    });
});

require __DIR__.'/auth.php';
