<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InvestorController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\PayableController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\InstalmentController;
use App\Http\Controllers\desingationContoller;

use App\Http\Controllers\payScaleContoller;
use App\Models\Instalment;

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

Route::get('/home', [\App\Http\Controllers\Controller::class,'index'])->name('index');
Route::get('/users', [\App\Http\Controllers\Controller::class,'Users'])->name('users');

Route::get('/', [\App\Http\Controllers\Controller::class,'index'])->name('index');
Route::get('/setup', [\App\Http\Controllers\Controller::class,'setup'])->name('setup');
Route::get('/types', [\App\Http\Controllers\Controller::class,'createAccountTypes'])->name('types');
Route::get('/test/{id}', [\App\Http\Controllers\Controller::class,'testSql'])->name('test');

Route::get('/home/{id}', [\App\Http\Controllers\Controller::class,'home'])->name('home');
Route::get('/calender' , [\App\Http\Controllers\Controller::class,'showCalender'])->name('calender');
Route::get('/investor-cash-accounts/{id}' , [\App\Http\Controllers\Controller::class,'getInvestorAccount'])->name('investor-cash-accounts');
// temporary routes
// Route::get('/purchase' , [\App\Http\Controllers\Controller::class,'showPurchase'])->name('purchase');

Route::get('/capital-investments' , [\App\Http\Controllers\Controller::class,'showInvestments'])->name('capital-investments');
Route::get('/get-items' , [\App\Http\Controllers\ItemController::class,'getItems'])->name('get-items');

Route::get('/get-purchase-items/{id}' , [\App\Http\Controllers\PurchaseController::class,'showPurchaseItems'])->name('get-purchase-items');
Route::get('/get-purchases/{id}' , [\App\Http\Controllers\PurchaseController::class,'showPurchases'])->name('get-purchases');
Route::get('/purchase-return' , [\App\Http\Controllers\PurchaseController::class,'purchaseReturn'])->name('purchase-return');
Route::get('/get-last-purchase' , [\App\Http\Controllers\PurchaseController::class,'getLastPurchase'])->name('get-last-purchase');

Route::get('/get-sales/{id}' , [\App\Http\Controllers\SaleController::class,'showSales'])->name('get-sales');
Route::get('/sale-return' , [\App\Http\Controllers\SaleController::class,'saleReturns'])->name('sale-return');
Route::get('/get-sale-no' , [\App\Http\Controllers\SaleController::class,'getSaleNo'])->name('get-sale-no');
Route::post('/post-return' , [\App\Http\Controllers\SaleController::class,'postReturn'])->name('post-return');
Route::get('/post-return' , [\App\Http\Controllers\SaleController::class,'redirectPost'])->name('post-return2');
Route::get('/get-sale-instalments' , [\App\Http\Controllers\SaleController::class,'showInstalments'])->name('get-sale-instalments');
Route::get('/test-pdf' , [\App\Http\Controllers\SaleController::class,'testPdf'])->name('test-pdf');
Route::get('/get-invoices' , [\App\Http\Controllers\SaleController::class,'getInvoices'])->name('get-invoices');
// Route::get('/search-sales' , [\App\Http\Controllers\SaleController::class,'searchSales'])->name('search-sales');
Route::get('/search-sales' , [\App\Http\Controllers\SaleController::class,'searchSalesPost'])->name('search-sales-post');
Route::get('/sale-close' , [\App\Http\Controllers\SaleController::class,'saleClose2'])->name('sale-close');



Route::get('/list-inventory/{id}' , [\App\Http\Controllers\InventoryController::class,'showInventory'])->name('list-inventory');
Route::get('/get-investor-items' , [\App\Http\Controllers\InventoryController::class,'getInvestorInventory'])->name('get-investor-items');

Route::get('/get-payables/{id}' , [\App\Http\Controllers\PayableController::class,'getPayables'])->name('get-payables');
Route::get('/get-payables-temp/{id}' , [\App\Http\Controllers\PayableController::class,'payablesRepTem'])->name('get-payables-temp');

Route::get('/customer-by-name' , [\App\Http\Controllers\CustomerController::class,'customerByName'])->name('customer-by-name');

Route::get('/get-recovery-off' , [\App\Http\Controllers\Controller::class,'getRecoveryOff'])->name('get-recovery-off');
Route::get('/get-marketing-off' , [\App\Http\Controllers\Controller::class,'getMarketingOff'])->name('get-marketing-off');

Route::get('/get-commissions' , [\App\Http\Controllers\CommissionController::class,'getCommisions'])->name('get-commissions');
Route::post('/commission-report' , [\App\Http\Controllers\CommissionController::class,'commissionReport'])->name('commission-report');
Route::get('/commission-report' , [\App\Http\Controllers\CommissionController::class,'commissionReport'])->name('commission-report2s');
Route::get('/recieve-instalment/{instalment}' , [\App\Http\Controllers\InstalmentController::class,'recieveInstalment'])->name('recieve-instalment');
Route::post('/pay-instalment' , [\App\Http\Controllers\InstalmentController::class,'payInstalment'])->name('pay-instalment');
Route::get('/show-instalment-payments/{id}' , [\App\Http\Controllers\InstalmentController::class,'showInstalmentDetails'])->name('show-instalment-payments');
Route::get('/pay-instalment' , function (){});





Auth::routes();
Route::resource('investor', InvestorController::class);
Route::resource('customer', CustomerController::class);
Route::resource('account', AccountController::class);
Route::resource('item', ItemController::class);
Route::resource('store', StoreController::class);
Route::resource('inventory', InventoryController::class);
Route::resource('purchase', PurchaseController::class);
Route::resource('sale', SaleController::class);
Route::resource('payable',PayableController::class);
Route::resource('supplier',SupplierController::class);
Route::resource('commission', CommissionController::class);
Route::resource('designation', desingationContoller::class);
Route::resource('payScale', payScaleContoller::class);
Route::resource('instalment',InstalmentController::class);










// Route::group(['prefix' => 'item'] , function() {
//     // Route::get('/', [\App\Http\Controllers\Controller::class, 'items'])->name('items');
//     Route::get('/get-items' , [ItemController::class,'getItems'])->name('get-items');

// });

// Route::group(['prefix' => 'set'] , function() {
//     // Route::get('/', [\App\Http\Controllers\Controller::class, 'items'])->name('items');
//     Route::get('/get-sets' , [setController::class,'getSets'])->name('get-sets');
//     Route::get('/create-set/{id}' , [\App\Http\Controllers\SetItemController::class,'createSet'])->name('create-set');
//     Route::get('/get-matching-items/{id}' , [\App\Http\Controllers\SetItemController::class,'getMatchingItems'])->name('get-matching-items');
//     Route::post('/add-item-to-set/{id}' , [\App\Http\Controllers\SetItemController::class,'addItemToSet'])->name('addItemToSet');
    

// });

// Route::get('/get-sets' , [SetController::class,'getSets'])->name('get-sets');
// Route::resource('item', ItemController::class);
// Route::resource('set', SetController::class);



