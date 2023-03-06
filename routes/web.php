<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InvestorController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ChartOfAccountController;
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
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\PayScaleController;
use App\Http\Controllers\payScaleContoller;
use App\Http\Controllers\PaySalaryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryPropController;
use App\Http\Controllers\ExpenseHeadController;



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

// Route::get('/home', [\App\Http\Controllers\Controller::class,'index'])->name('index');
Route::get('/users', [\App\Http\Controllers\Controller::class,'Users'])->name('users');
Route::get('/', [\App\Http\Controllers\Controller::class,'index'])->name('index');
Route::get('/setup', [\App\Http\Controllers\Controller::class,'setup'])->name('setup');
Route::get('/types', [\App\Http\Controllers\Controller::class,'createAccountTypes'])->name('types');
Route::get('/test/{id}', [\App\Http\Controllers\Controller::class,'testSql'])->name('test');
Route::get('/home/{id}', [\App\Http\Controllers\Controller::class,'home'])->name('home');
Route::get('/calender' , [\App\Http\Controllers\Controller::class,'showCalender'])->name('calender');
Route::get('/investor-cash-accounts/{id}' , [\App\Http\Controllers\Controller::class,'getInvestorAccount'])->name('investor-cash-accounts');
Route::get('/get-recovery-off' , [\App\Http\Controllers\Controller::class,'getRecoveryOff'])->name('get-recovery-off');
Route::get('/get-marketing-off' , [\App\Http\Controllers\Controller::class,'getMarketingOff'])->name('get-marketing-off');
Route::get('/get-inquiry-off' , [\App\Http\Controllers\Controller::class,'getInquiryOff'])->name('get-inquiry-off');
Route::get('/capital-investments' , [\App\Http\Controllers\Controller::class,'showInvestments'])->name('capital-investments');
// temporary routes
// Route::get('/purchase' , [\App\Http\Controllers\Controller::class,'showPurchase'])->name('purchase');


Route::get('/get-items' , [\App\Http\Controllers\ItemController::class,'getItems'])->name('get-items');
Route::get('/get-item/{id}' , [\App\Http\Controllers\ItemController::class,'Itemdetail'])->name('get-item');

Route::get('/get-purchase-items/{id}' , [\App\Http\Controllers\PurchaseController::class,'showPurchaseItems'])->name('get-purchase-items');
Route::get('/get-purchases' , [\App\Http\Controllers\PurchaseController::class,'showPurchases'])->name('get-purchases');
Route::get('/get-purchases-post' , [\App\Http\Controllers\PurchaseController::class,'showPurchasesPost'])->name('get-purchases-post');
Route::get('/purchase-return' , [\App\Http\Controllers\PurchaseController::class,'purchaseReturn'])->name('purchase-return');
Route::get('/get-last-purchase' , [\App\Http\Controllers\PurchaseController::class,'getLastPurchase'])->name('get-last-purchase');


Route::get('/get-sales/{id}' , [\App\Http\Controllers\SaleController::class,'showSales'])->name('get-sales');
Route::get('/sale-return' , [\App\Http\Controllers\SaleController::class,'saleReturn'])->name('sale-return');
Route::put('/sale-return-adjusment' , [\App\Http\Controllers\SaleController::class,'saleReturnAdjustment'])->name('sale-return-adjustment');
Route::Post('/post-return-adjustment' , [\App\Http\Controllers\SaleController::class,'postReturnAdjustment'])->name('post-return-adjustment');
Route::get('/get-sale-no' , [\App\Http\Controllers\SaleController::class,'getSaleNo'])->name('get-sale-no');
Route::get('/get-sale-instalments' , [\App\Http\Controllers\SaleController::class,'showInstalments'])->name('get-sale-instalments');
Route::get('/test-pdf' , [\App\Http\Controllers\SaleController::class,'testPdf'])->name('test-pdf');
Route::get('/get-invoices' , [\App\Http\Controllers\SaleController::class,'getInvoices'])->name('get-invoices');
Route::get('/search-sales' , [\App\Http\Controllers\SaleController::class,'searchSalesPost'])->name('search-sales-post');
Route::get('/sale-close' , [\App\Http\Controllers\SaleController::class,'saleClose'])->name('sale-close');
Route::get('/post-sale' , [\App\Http\Controllers\SaleController::class,'postSale'])->name('post-sale');
Route::post('/reprint-invoice' , [\App\Http\Controllers\SaleController::class,'reprintInvoice'])->name('reprint-invoice');
Route::get('/cancel-sale' , [\App\Http\Controllers\SaleController::class,'cancelSale'])->name('cancel-sale');
// Route::get('/search-sales' , [\App\Http\Controllers\SaleController::class,'searchSales'])->name('search-sales');


Route::get('/list-inventory/{id}' , [\App\Http\Controllers\InventoryController::class,'showInventory'])->name('list-inventory');
Route::get('/get-investor-items' , [\App\Http\Controllers\InventoryController::class,'getInvestorInventory'])->name('get-investor-items');

Route::get('/get-payables/{id}' , [\App\Http\Controllers\PayableController::class,'getPayables'])->name('get-payables');
Route::get('/get-payables-temp/{id}' , [\App\Http\Controllers\PayableController::class,'payablesRepTem'])->name('get-payables-temp');


Route::get('/get-commissions' , [\App\Http\Controllers\CommissionController::class,'getCommisions'])->name('get-commissions');
Route::post('/commission-report' , [\App\Http\Controllers\CommissionController::class,'commissionReport'])->name('commission-report');
Route::get('/commission-report' , [\App\Http\Controllers\CommissionController::class,'commissionReport'])->name('commission-report2s');

Route::get('/recieve-instalment/{instalment}' , [\App\Http\Controllers\InstalmentController::class,'recieveInstalment'])->name('recieve-instalment');
Route::post('/pay-instalment' , [\App\Http\Controllers\InstalmentController::class,'payInstalment'])->name('pay-instalment');
Route::get('/show-instalment-payments/{id}' , [\App\Http\Controllers\InstalmentController::class,'showInstalmentDetails'])->name('show-instalment-payments');
Route::get('/show-instalment-payment/{id}' , [\App\Http\Controllers\InstalmentController::class,'showInstalmentPayment'])->name('show-instalment-payment');

Route::get('/pay-instalment' , function (){});
Route::get('/show-expenses-post' , [\App\Http\Controllers\ExpenseController::class,'showExpensesPost'])->name('show-expenses-post');
Route::get('/show-expenses' , [\App\Http\Controllers\ExpenseController::class,'showExpenses'])->name('show-expenses');

Route::get('/get-salary-post' , [\App\Http\Controllers\PaySalaryController::class,'paySalaryPost'])->name('get-salary-post');

Route::get('/edit-designation/{id}' , [\App\Http\Controllers\desingationContoller::class,'editDesignation'])->name('edit-designation');
Route::Post('/change-designation' , [\App\Http\Controllers\desingationContoller::class,'changeDesignation'])->name('change-designation');

Route::get('/create-property/{id}' , [\App\Http\Controllers\CategoryPropController::class,'createProperty'])->name('create-property');
Route::get('/get-properties/{id}' , [\App\Http\Controllers\CategoryPropController::class,'getProperties'])->name('get-properties');

Route::get('/get-account-balances' , [\App\Http\Controllers\GLController::class,'AccountBalances'])->name('get-account-balances');
Route::get('/transfer-balances' , [\App\Http\Controllers\GLController::class,'transferBalances'])->name('transfer-balances');
Route::post('/bnk_transfer' , [\App\Http\Controllers\GLController::class,'bankTransfer'])->name('bnk_transfer');

Route::get('/customer-files/{id}' , [\App\Http\Controllers\CustomerController::class,'customerFiles'])->name('customer-files');
Route::post('/customer-file-upload' , [\App\Http\Controllers\CustomerController::class,'customerFileUpload'])->name('customer-file-upload');
Route::get('/customer-by-name' , [\App\Http\Controllers\CustomerController::class,'customerByName'])->name('customer-by-name');

Route::get('/add-sub-exp-heads{id}' , [\App\Http\Controllers\ExpenseHeadController::class,'addSubexpHeads'])->name('add-sub-exp-head');
Route::POST('/store-Subexp-Heads' , [\App\Http\Controllers\ExpenseHeadController::class,'storeSubexpHeads'])->name('storeSubexpHeads');

Route::get('/ro-dashboard' , [\App\Http\Controllers\RecoveryController::class,'roDashboard'])->name('ro-dashboard');



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
Route::resource('expense',ExpenseController::class);
Route::resource('payScale',PayScaleController::class);
Route::resource('paySalary',PaySalaryController::class);
Route::resource('chartOfAccount',ChartOfAccountController::class);
Route::resource('category',CategoryController::class);
Route::resource('categoryProperty',CategoryPropController::class);
Route::resource('expenseHead',ExpenseHeadController::class);

















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



