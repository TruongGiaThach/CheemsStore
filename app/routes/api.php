<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
Route::get('/products', 'ProductController@index');
Route::post('/products', 'ProductController@store');
Route::post('/upload-file', 'ProductController@uploadFile');
Route::get('/products/{product}', 'ProductController@show');
Route::delete('/products/{product_id}', 'ProductController@destroy');
Route::put('/products/{product}', "ProductController@update");
Route::get('/image/{product_image}', 'ImageController@deleteImage');
//staff
Route::get('/staffs', 'StaffController@index');
Route::get('/staffs/{staff}', 'StaffController@show');
Route::post('/staffs', 'StaffController@store');
Route::patch('staffs/{staff}','StaffController@update');

Route::get('/users','UserController@index');
Route::get('users/{user}','UserController@show');
Route::patch('users/{user}','UserController@update');
Route::patch('products/{product}/units/add','ProductController@updateUnits');
Route::resource('/products', 'ProductController')->except(['index','show']);
Route::resource('category', 'CategoryController');

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
