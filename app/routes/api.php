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
//staff
Route::get('/staffs', 'StaffController@index');
Route::get('/staffs/{staff}', 'StaffController@show');
Route::post('/staffs', 'StaffController@store');
Route::patch('staffs/{staff}','StaffController@update');
Route::delete('staffs/{email}','StaffController@destroy');
Route::put('staffs/{id}','StaffController@update');
//receipt
Route::get('/receipt', 'ReceiptController@index');
Route::get('/receipt_detail', 'ReceiptDetailController@index');
Route::post('/receipt', 'ReceiptController@store');
Route::post('/receipt_detail', 'ReceiptDetailController@store');
//customer
Route::get('/customer', 'CustomerController@index');
Route::post('/customer', 'CustomerController@store');

Route::get('/users','UserController@index');
Route::patch('users','UserController@log_out');
Route::patch('users/{user}','UserController@update');
Route::delete('users/{email}','UserController@destroy');
Route::get('users/{user}/orders','UserController@showOrders');
Route::patch('products/{product}/units/add','ProductController@updateUnits');
Route::resource('/products', 'ProductController')->except(['index']);

//category
Route::resource('category', 'CategoryController')->except(['index']);
Route::post('/category', 'CategoryController@store');
Route::put('/category/{category_id}', 'CategoryController@update');
Route::delete('/category/{category_id}', 'CategoryController@destroy');
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
