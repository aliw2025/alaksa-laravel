<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
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
use App\Http\Controllers\GLController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\SupplierPaymentController;
use App\Models\Instalment;
use App\Models\SupplierPayment;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Role as ModelsRole;

/* |-------------------------------------------------------------------------- | Web Routes |-------------------------------------------------------------------------- | | Here is where you can register web routes for your application. These | routes are loaded by the RouteServiceProvider within a group which | contains the "web" middleware group. Now create something great! | */

// controller Instalment Controller
Route::controller(Controller::class)->group(function () {
        Route::get('/users', 'Users')->name('users');
        Route::get('/',  'index')->name('index');
        Route::group(['middleware' => ['role:admin']], function () {
                Route::get('/setup',  'setup')->name('setup');
                Route::get('/types',  'createAccountTypes')->name('types');
        });
        Route::get('/test/{id}',  'testSql')->name('test');
        Route::get('/home/{id}',  'home')->name('home');
        Route::get('/calender',  'showCalender')->name('calender');
        Route::get('/investor-cash-accounts/{id}',  'getInvestorAccount')->name('investor-cash-accounts');
        Route::get('/get-recovery-off',  'getRecoveryOff')->name('get-recovery-off');
        Route::get('/get-marketing-off',  'getMarketingOff')->name('get-marketing-off');
        Route::get('/get-inquiry-off',  'getInquiryOff')->name('get-inquiry-off');
        Route::get('/capital-investments',  'showInvestments')->name('capital-investments');
        Route::get('/admin',  'admin')->name('admin');
});

// controller Instalment Controller
Route::controller(RolePermissionController::class)->group(function () {

        // roles routes of admin
        Route::group(['middleware' => ['role:admin']], function () {
                Route::get('/roles', 'roles')->name('roles');
                Route::POST('/role', 'storeRole')->name('store-role');
                Route::get('/role', function () {
                });
                Route::get('/edit-role/{id}', 'editRole')->name('edit-role');
                Route::post('/update-role/{id}', 'updateRole')->name('update-role');
                Route::POST('/delete-role/{id}', 'deleteRole')->name('delete-role');

                // permissions routes
                Route::get('/permissions', 'permissions')->name('permissions');
                Route::POST('/permission', 'storePermission')->name('store-permission');
                Route::get('/permission', function () {
                });
                Route::get('/edit-permission/{id}', 'editPermission')->name('edit-permission');
                Route::post('/update-permission/{id}', 'updatePermission')->name('update-permission');
                Route::POST('/delete-permission/{id}', 'deletePermission')->name('delete-permission');


                // role permission mapping
                Route::get('/roles-permissions', 'rolePermissions')->name('roles-permissions');
                Route::post('/role-permissions', 'storeRolePermission')->name('role-permissions');
                Route::post('/unassign-role-permissions', 'unassignRolePermission')->name('unassign-role-permissions');


                // get pesmissions of a role
                Route::get('/get-role-permissions', 'getRolePermissions')->name('get-role-permissions');
                Route::get('/get-user-roles', 'getUserRoles')->name('get-user-roles');

                // unassing permsiion from role

                // user roles
                Route::get('/user-roles', 'userRoles')->name('user-roles');
                Route::post('/user-roles', 'storeUserRoles')->name('store-user-roles');
                Route::post('/unassign-user-roles', 'unassignUserRoles')->name('unassign-user-roles');
        });
});


// sale controller
Route::controller(SaleController::class)->group(function () {

        Route::get('/get-sales/{id}',  'showSales')->name('get-sales');
        Route::get('/sale-return',  'saleReturn')->name('sale-return');
        Route::put('/sale-return-adjusment',  'saleReturnAdjustment')->name('sale-return-adjustment');
        Route::Post('/post-return-adjustment',  'postReturnAdjustment')->name('post-return-adjustment');
        Route::get('/get-sale-no',  'getSaleNo')->name('get-sale-no');
        Route::get('/get-sale-instalments',  'showInstalments')->name('s');
        Route::get('/test-pdf',  'testPdf')->name('test-pdf');
        Route::get('/get-invoices',  'getInvoices')->name('get-invoices');
        Route::get('/search-sales',  'searchSalesPost')->name('search-sales-post');
        Route::get('/sale-close',  'saleClose')->name('sale-close');
        Route::get('/post-sale',  'postSale')->name('post-sale');
        Route::post('/reprint-invoice',  'reprintInvoice')->name('reprint-invoice');
        Route::get('/cancel-sale',  'cancelSale')->name('cancel-sale');
});

// purchase Controller
Route::controller(PurchaseController::class)->group(function () {

        Route::get('/get-purchase-items/{id}',  'showPurchaseItems')->name('get-purchase-items');
        Route::get('/get-purchases',  'showPurchases')->name('get-purchases');
        Route::get('/get-purchases-post',  'showPurchasesPost')->name('get-purchases-post');
        Route::get('/purchase-return',  'purchaseReturn')->name('purchase-return');
        Route::get('/get-last-purchase',  'getLastPurchase')->name('get-last-purchase');
        Route::get('/post-purchase',  'postPurchase')->name('post-purchase');
        Route::get('/unpost-purchase',  'unpostPurchase')->name('unpost-purchase');

        Route::get('/cancel-purchase',  'cancelPurchase')->name('cancel-purchase');    
});

// Instalment Controller
Route::controller(InstalmentController::class)->prefix('instalment')->group(function () {
        Route::get('/recieve-instalment/{instalment}', 'recieveInstalment')->name('recieve-instalment');
        Route::post('/pay-instalment', 'payInstalment')->name('pay-instalment');
        Route::get('/show-instalment-payments/{id}', 'showInstalmentDetails')->name('show-instalment-payments');
        Route::get('/show-instalment-payment/{id}', 'showInstalmentPayment')->name('show-instalment-payment');
        Route::get('/up-comming-instalments', 'showUpcomingInstalments')->name('show-upcoming-instalments');
        Route::post('/extend-instalment', 'extendInstalment')->name('extend-instalment');
        Route::get('/get-instalment-extentions', 'getInstalmentExt')->name('get-instalment-extentions');
});

// General Leadger Controller
Route::controller(GLController::class)->group(function () {

        Route::get('/get-account-balances',  'AccountBalances')->name('get-account-balances');
        Route::get('/get-user-acc-balances',  'userAccountBalances')->name('get-user-acc-balances');
        Route::get('/transfer-balances',  'transferBalances')->name('transfer-balances');
        Route::get('/user-transfer-balances',  'userTransferBalances')->name('user-transfer-balances');
        Route::post('/add-transfer-request',  'addTransferRequest')->name('add-transfer-request');
        Route::get('/investor-transfer-queue',  'investorApprovalQueue')->name('investor-transfer-queue');
        Route::get('/ro-transfer-queue',  'userApprovalQueue')->name('ro-transfer-queue');
        Route::post('/ro--transfer-approval',  'userApproval')->name('ro--transfer-approval');
        Route::post('/bnk_transfer',  'bankTransfer')->name('bnk_transfer');
        Route::get('/investor-payment',  'investorPaymentCreate')->name('investor-payment');
        Route::post('/investor-payment',  'investorPaymentStore')->name('investor-payment');


       
});

// Customer Controller
Route::controller(CustomerController::class)->group(function () {

        Route::get('/customer-files/{id}',  'customerFiles')->name('customer-files');
        Route::post('/customer-file-upload',  'customerFileUpload')->name('customer-file-upload');
        Route::get('/customer-by-name',  'customerByName')->name('customer-by-name');
});

// Item Controller
Route::controller(ItemController::class)->group(function () {
        Route::get('/get-items', 'getItems')->name('get-items');
        Route::get('/get-item/{id}', 'Itemdetail')->name('get-item');
});

// Inventory Controller
Route::controller(InventoryController::class)->group(function () {

        Route::get('/list-inventory/{id}',  'showInventory')->name('list-inventory');
        Route::get('/get-investor-items',  'getInvestorInventory')->name('get-investor-items');
});

// payable Controller
Route::controller(PayableController::class)->group(function () {

      
});

Route::controller(SupplierPaymentController::class)->group(function(){

        Route::get('/get-payables/{id}',  'getPayables')->name('get-payables');
        Route::get('/get-payables-temp/{id}',  'payablesRepTem')->name('get-payables-temp');
        Route::get('/show-supplierPayments',  'showSupplierPayments')->name('show-supplierPayments');
        Route::get('/post-supplierPayment',  'postSupplierPayment')->name('post-supplierPayment');
        Route::get('/unpost-supplierPayment',  'UnpostSupplierPayment')->name('unpost-supplierPayment');
        Route::get('/cancel-supplierPayment',  'cancelSupplierPayment')->name('cancel-supplierPayment');  
});

// CommsissionController
Route::controller(CommissionController::class)->group(function () {

        Route::get('/get-commissions',  'getCommisions')->name('get-commissions');
        Route::post('/commission-report',  'commissionReport')->name('commission-report');
        Route::get('/commission-report',  'commissionReport')->name('commission-report2s');
});
Route::get('/pay-instalment', function () {
});



// Expense Controller
Route::controller(ExpenseController::class)->group(function () {

        Route::get('/show-expenses-post',  'showExpensesPost')->name('show-expenses-post');
        Route::get('/show-expenses',  'showExpenses')->name('show-expenses');
        Route::get('/post-expense',  'postExpense')->name('post-expense');
        Route::get('/unpost-expense',  'UnpostExpense')->name('unpost-expense');
        Route::get('/cancel-expense',  'cancelExpense')->name('cancel-expense');   
});
// investment Controller
Route::controller(InvestmentController::class)->group(function () {

        Route::get('/show-investments-post',  'showInvestmentsPost')->name('show-investments-post');
        Route::get('/show-investments',  'showInvestments')->name('show-investments');
        Route::get('/post-investment',  'postInvestment')->name('post-investment');
        Route::get('/unpost-investment',  'UnpostInvestment')->name('unpost-investment');
        Route::get('/cancel-investment',  'cancelInvestment')->name('cancel-investment');   
});



// Designation Controller
Route::controller(desingationContoller::class)->group(function () {

        Route::get('/edit-designation/{id}', 'editDesignation')->name('edit-designation');
        Route::Post('/change-designation', 'changeDesignation')->name('change-designation');
});

// caategoryPropController
Route::controller(CategoryPropController::class)->group(function () {

        Route::get('/create-property/{id}', 'createProperty')->name('create-property');
        Route::get('/get-properties/{id}', 'getProperties')->name('get-properties');
});

// Expense Controller
Route::controller(ExpenseHeadController::class)->group(function () {

        Route::get('/add-sub-exp-heads{id}',  'addSubexpHeads')->name('add-sub-exp-head');
        Route::POST('/store-Subexp-Heads',  'storeSubexpHeads')->name('storeSubexpHeads');
        Route::get('/get-sub-heads',  'getSubHeads')->name('get-sub-heads');

});

// chartOfAccountController
Route::controller(ChartOfAccountController::class)->prefix('chart-of-accounts')->group(function () {

        Route::get('/create-cashier-account', 'userAccountsCreate')->name('create-user-accounts');
        Route::post('/store-cashier-account', 'userAccountsStore')->name('store-user-accounts');
});


//  recovery officer Controller
Route::get('/ro-dashboard', [\App\Http\Controllers\RecoveryController::class, 'roDashboard'])->name('ro-dashboard');

//pay salary controller 
Route::get('/get-salary-post', [\App\Http\Controllers\PaySalaryController::class, 'paySalaryPost'])->name('get-salary-post');


// temporary routes
// Route::get('/purchase' , [\App\Http\Controllers\Controller::class,'showPurchase'])->name('purchase');


// resource Routers
Auth::routes();
Route::resource('investor', InvestorController::class);
Route::resource('customer', CustomerController::class);
Route::resource('account', AccountController::class);
Route::resource('item', ItemController::class);
Route::resource('store', StoreController::class);
Route::resource('inventory', InventoryController::class);
Route::resource('purchase', PurchaseController::class);
Route::resource('sale', SaleController::class);

// Route::resource('payable', PayableController::class);
Route::resource('supplierPayment', SupplierPaymentController::class);
Route::resource('supplier', SupplierController::class);
Route::resource('commission', CommissionController::class);
Route::resource('designation', desingationContoller::class);
Route::resource('payScale', payScaleContoller::class);
Route::resource('instalment', InstalmentController::class);
Route::resource('expense', ExpenseController::class);
Route::resource('payScale', PayScaleController::class);
Route::resource('paySalary', PaySalaryController::class);
Route::resource('chartOfAccount', ChartOfAccountController::class);
Route::resource('category', CategoryController::class);
Route::resource('categoryProperty', CategoryPropController::class);
Route::resource('expenseHead', ExpenseHeadController::class);
Route::resource('investment', InvestmentController::class);

