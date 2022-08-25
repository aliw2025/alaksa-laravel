<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SetController;


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
Route::get('/home', [\App\Http\Controllers\Controller::class,'home']);
Route::get('/calender' , [\App\Http\Controllers\Controller::class,'showCalender'])->name('calender');

// test routes
Route::get('/test-set' , [\App\Http\Controllers\Controller::class,'testSet'])->name('testSet');
Route::get('/test-add/{id}' , [\App\Http\Controllers\Controller::class,'testAdd'])->name('testAdd');
Route::get('/show-set/{id}' , [\App\Http\Controllers\Controller::class,'showSet'])->name('showSet');
Route::get('/show-item/{id}' , [\App\Http\Controllers\Controller::class,'showItem'])->name('showItem');

Auth::routes();

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



