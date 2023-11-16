<?php
/////////////////Dashboard///////////////////
use App\Http\Controllers\DashboardController;
//////////////////USERS///////////////////////
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Users\AddUserController;
use App\Http\Controllers\Users\RoleController;
/////////////////EXPENSES/////////////////////
use App\Http\Controllers\Expenses\ExpensesController;
use App\Http\Controllers\Expenses\ExpenseCategoryController;
/////////////////ITMES/////////////////////
use App\Http\Controllers\Items\ItemController;
use App\Http\Controllers\Items\ItemCategoryController;
use App\Http\Controllers\Items\StockCountController;
/////////////////POS/////////////////////
use App\Http\Controllers\POS\POSController;
use App\Http\Controllers\POS\SessionController;
/////////////////SALES/////////////////////
use App\Http\Controllers\Sales\SalesController;
/////////////////SUPPLIERS/////////////////////
use App\Http\Controllers\Suppliers\SupplierController;
/////////////////Customers/////////////////////
use App\Http\Controllers\Customers\CustomerController;
/////////////////Purchase/////////////////////
use App\Http\Controllers\Purchase\PurchaseController;
use App\Http\Controllers\Purchase\PaymentsController;
/////////////////Warehouse/////////////////////
use App\Http\Controllers\Warehouses\WarehouseController;



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/register', [AuthController::class,'registerShow'])->name('register.show');
Route::get('/login', [AuthController::class,'loginShow'])->name('login');
Route::post('/login', [AuthController::class,'loginSave'])->name('login.save');

Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name('lang');

Route::group(['middleware' => ['auth','setLocale']], function (){
    Route::get('/', [DashboardController::class,'index'])->name('index');
    Route::group(['middleware' => ['permission:users-manage']], function (){
        Route::get('/users', [UserController::class,'index'])->name('users.show');
        Route::get('/user/add', [AddUserController::class,'index'])->name('users.add.form.show');
        Route::post('/user/add', [AddUserController::class,'save'])->name('users.add.form.save');
        Route::get('/roles', [RoleController::class,'index'])->name('roles.show');
        Route::get('/role/add', [RoleController::class,'create'])->name('roles.add.form.show');
        Route::post('/role/add', [RoleController::class,'save'])->name('roles.add.form.save');
        Route::get('/role/permissions/{role_id}', [RoleController::class,'role_permissions'])->name('role.permissions');
        Route::post('/role/save-permissions/{role_id}', [RoleController::class,'SavePermissions'])->name('role.permissions.save');

    });

    Route::group(['middleware' => ['permission:expenses-manage']], function (){
        Route::get('/expenses', [ExpensesController::class,'index'])->name('expenses.show');
        Route::get('/expense/add', [ExpensesController::class,'create'])->name('expenses.add.form.show');
        Route::post('/expense/add', [ExpensesController::class,'save'])->name('expenses.add.form.save');
        Route::get('/expenses/categories', [ExpenseCategoryController::class,'index'])->name('expenses.categories.show');
        Route::get('/expenses/category/add', [ExpenseCategoryController::class,'create'])->name('expenses.category.add.form.show');
        Route::post('/expenses/category/add', [ExpenseCategoryController::class,'save'])->name('expenses.category.add.form.save');
        Route::get('/expenses/category/active/{id}', [ExpenseCategoryController::class,'active'])->name('expenses.category.active');

    });

    Route::group(['middleware' => ['permission:items-manage']], function (){        
        Route::get('/items', [ItemController::class,'index'])->name('items.show');
        Route::get('/item/active/{id}', [ItemController::class,'active'])->name('item.active');
        Route::get('/items/add', [ItemController::class,'create'])->name('items.add.form.show');
        Route::post('/items/add', [ItemController::class,'save'])->name('items.add.form.save');
        Route::get('/items/category/add', [ItemCategoryController::class,'create'])->name('items.category.add.form.show');
        Route::post('/items/category/add', [ItemCategoryController::class,'save'])->name('items.category.add.form.save');
        Route::get('/items/categories', [ItemCategoryController::class,'index'])->name('items.categories.show');
        Route::get('/items/category/active/{id}', [ItemCategoryController::class,'active'])->name('item.category.active');
        Route::get('/items/stock-count', [StockCountController::class,'index'])->name('items.stock.count');
        Route::get('/items/stock-count/warehouse/ajax', [WarehouseController::class,'get_warehouses_ajax'])->name('stock.count.warehouses');
        Route::get('/items/stock-count/initial_file', [StockCountController::class,'InitialFile'])->name('items.stock.count.intial');
        Route::get('/items/stock-count/download/{filename}', [StockCountController::class,'DownloadFile'])->name('items.stock.count.file.download');
        Route::post('/items/stock-count/final_file/{id}', [StockCountController::class,'UploadFinalFile'])->name('items.stock.count.upload.final');

    });

    Route::get('/sales', [SalesController::class,'index'])->name('sales.show');
    Route::get('/sales/add', [SalesController::class,'create'])->name('sales.add.form.show');
    Route::get('/sales/invoice/{invoice_id}/details', [SalesController::class,'invoice_details'])->name('sales.invoice.details.show');
    Route::get('/invoice/{invoice_id}/pdf', [SalesController::class,'invoice_pdf'])->name('invoice.pdf');
    Route::get('/sales/filter', [SalesController::class,'search_invoice'])->name('sales.filter');
    Route::get('/sales/filter/billers/ajax', [UserController::class,'get_billers_ajax'])->name('sales.filter.billers');
    Route::get('/sales/filter/warehouse/ajax', [WarehouseController::class,'get_warehouses_ajax'])->name('sales.filter.warehouses');
    Route::get('/sales/filter/customers/ajax', [CustomerController::class,'get_customers_ajax'])->name('sales.filter.customers');


    Route::get('/suppliers', [SupplierController::class,'index'])->name('suppliers.show');
    Route::get('/suppliers/add', [SupplierController::class,'create'])->name('suppliers.add.form.show');
    Route::post('/suppliers/add', [SupplierController::class,'save'])->name('suppliers.add.form.save');
    Route::get('/supplier/active/{id}', [SupplierController::class,'active'])->name('supplier.active');

    Route::get('/customers', [CustomerController::class,'index'])->name('customers.show');
    Route::get('/customers/add', [CustomerController::class,'create'])->name('customers.add.form.show');
    Route::post('/customers/add', [CustomerController::class,'save'])->name('customers.add.form.save');
    Route::get('/customer/active/{id}', [CustomerController::class,'active'])->name('customer.active');

    Route::get('/purchases', [PurchaseController::class,'index'])->name('purchase.show');
    Route::get('/purchase/add', [PurchaseController::class,'create'])->name('purchase.add.form.show');
    Route::post('/purchase/add', [PurchaseController::class,'save'])->name('purchase.add.form.save');
    Route::get('/purchase/invoice/{invoice_id}/details', [PurchaseController::class,'invoice_details'])->name('purchase.invoice.details.show');
    Route::get('/purchase/filter', [PurchaseController::class,'search_invoice'])->name('purchase.filter');
    Route::get('/purchase/filter/billers/ajax', [UserController::class,'get_billers_ajax'])->name('purchase.filter.billers');
    Route::get('/purchase/filter/warehouse/ajax', [WarehouseController::class,'get_warehouses_ajax'])->name('purchase.filter.warehouses');
    Route::get('/purchase/filter/suppliers/ajax', [SupplierController::class,'get_suppliers_ajax'])->name('purchase.filter.suppliers');
    Route::post('/purchase/invoice/pay/{invoice_id}/{max_value}', [PaymentsController::class,'payInvoice'])->name('purchase.invoice.pay');
    Route::get('/purchases/payments', [PaymentsController::class,'index'])->name('payments.show');


    Route::get('/warehouses', [WarehouseController::class,'index'])->name('warehouses.show');
    Route::get('/warehouse/add', [WarehouseController::class,'create'])->name('warehouse.add.form.show');
    Route::post('/warehouse/add', [WarehouseController::class,'save'])->name('warehouse.add.form.save');

    Route::group(['middleware' => ['permission:pos']], function (){        
        Route::get('/pos', [POSController::class,'index'])->name('pos.show');
        Route::post('/pos/new/session', [SessionController::class,'start_session'])->name('pos.new.session');
        Route::get('/pos/close/session', [SessionController::class,'close_session'])->name('pos.close.session');
        Route::get('/pos/customers/ajax', [CustomerController::class,'get_customers_ajax'])->name('pos.customers.show');
        Route::get('/pos/item/details/ajax/{id}/{warehouse}', [ItemController::class,'item_details'])->name('pos.item.details');
        Route::post('/pos/new/invoice', [POSController::class,'sell'])->name('pos.new.invoice');
        Route::get('/pos/sessions', [SessionController::class,'index'])->name('pos.sessions.show');
    });
    Route::get('/pos/search/items/ajax/{query}', [ItemController::class,'search_item'])->name('pos.items.show');
    Route::get('/purchase/item/details/ajax/{id}', [ItemController::class,'pur_item_details'])->name('purchase.item.details');


    
});


