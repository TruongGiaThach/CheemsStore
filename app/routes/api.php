<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
Route::get('/products', 'ProductController@index');
Route::get('/products/find', 'ProductController@show');
Route::post('/products', 'ProductController@store');
Route::post('/upload-file', 'ProductController@uploadFile');
Route::get('/products/{product}', 'ProductController@show');
Route::delete('/products/{product_id}', 'ProductController@destroy');
Route::post('/products/{product}', "ProductController@update");
Route::put('/amount/products/{productId}', "ProductController@updateProductAmount");
//staff
Route::get('/staffs', 'StaffController@index');
Route::get('/staffs/{staff}', 'StaffController@show');
Route::post('/staffs', 'StaffController@store');
Route::patch('staffs/{staff}','StaffController@update');
Route::delete('staffs/{email}','StaffController@destroy');
Route::put('staffs/{id}','StaffController@update');
Route::get('/getStaffs/{email}', 'StaffController@getStaffWithEmail');
Route::get('/getStaffWithID/{id}', 'StaffController@getStaffWithId');
//receipt
Route::get('/receipt', 'ReceiptController@index');
Route::get('/receipt_detail', 'ReceiptDetailController@index');
Route::get('/receipt_detail/find', 'ReceiptDetailController@find');
Route::post('/receipt_details', 'ReceiptDetailController@getByReceiptId');
Route::post('/receipt', 'ReceiptController@store');
Route::post('/receipt_detail', 'ReceiptDetailController@store');
Route::put('/amount/receipt_detail/{receiptDetailId}', 'ReceiptDetailController@updateAmount');
Route::delete('/receipt_detail/{receiptDetailId}', 'ReceiptDetailController@destroy');
Route::post('/receipts', 'ReceiptController@getByCustomerID');
Route::get('/receipt/getReceipt', 'ReceiptController@getReceipt');
Route::put('/receipt/{receiptId}', 'ReceiptController@update');
//customer
Route::get('/customer', 'CustomerController@index');
Route::post('/customer', 'CustomerController@store');
Route::get('/customer/find', 'CustomerController@find');

Route::get('/users','UserController@index');
Route::patch('users','UserController@log_out');
Route::patch('users/{user}','UserController@update');
Route::delete('users/{email}','UserController@destroy');
Route::post('/updateUsers/{email}','UserController@updatePassword');
Route::get('users/{user}/orders','UserController@showOrders');
Route::patch('products/{product}/units/add','ProductController@updateUnits');
Route::resource('/products', 'ProductController')->except(['index']);

//category
Route::resource('category', 'CategoryController')->except(['index']);
Route::get('/category', 'CategoryController@index');
Route::post('/category', 'CategoryController@store');
Route::put('/category/{category_id}', 'CategoryController@update');
Route::delete('/category/{category_id}', 'CategoryController@destroy');
//History
Route::get('/histories', 'HistoryController@index');
Route::get('/histories/{id}','HistoryController@getStaff');
Route::post('/histories', 'HistoryController@store');
//product
Route::post('/productUpdate/{product_id}', 'ProductController@updateProductAmount');
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
