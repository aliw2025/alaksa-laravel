<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InvestorController;


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


Route::get('/', [\App\Http\Controllers\Controller::class,'index'])->name('index');
Route::get('/home/{id}', [\App\Http\Controllers\Controller::class,'home'])->name('home');
Route::get('/calender' , [\App\Http\Controllers\Controller::class,'showCalender'])->name('calender');
Route::get('/capital-investments' , [\App\Http\Controllers\Controller::class,'showInvestments'])->name('capital-investments');

Auth::routes();
Route::resource('investor', InvestorController::class);


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



