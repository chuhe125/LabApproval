<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/**
 * 登录注册模块
 */
Route::prefix('user')->group(function () {
    Route::post('login', 'Login\LoginController@login'); //管理员登陆
    Route::post('logout', 'Login\LoginController@logout'); //管理员退出登陆
    Route::post('registered', 'Login\LoginController@registered'); //管理员注册
});//--pxy


Route::middleware('auth.check:api')->get('/test', function (Request $request) {
    return $request->user();
});
Route::middleware('auth.rolecheck')->prefix('test')->group(function (){
   Route::post('pxy','Login\LoginController@test')->middleware('auth.rolecheck');//测试
});
