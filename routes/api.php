<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

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
Route::get('/test',function (Request $request) {
    return response([
        "result" => "good."
    ], 200);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response([
        "user" => Auth::user()
    ], 200);
});
Route::post('/register', "App\Http\Controllers\AuthController@register");
Route::post('/login', "App\Http\Controllers\AuthController@login");
Route::middleware('auth:sanctum')->post('/logout', "App\Http\Controllers\AuthController@logout");
Route::middleware('auth:sanctum')->get('/user', "App\Http\Controllers\AuthController@index");
Route::middleware('auth:sanctum')->get('/user/module', "App\Http\Controllers\ModuleController@getModules");
