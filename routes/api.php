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
/***
 * 超级管理员模块
 */
Route::prefix('super')->group(function () {
     Route::get('getcount','SuperAdmin\SuperAdminController@getCount'); //表单数量统计-总数
     Route::get('getpending','SuperAdmin\SuperAdminController@getPending');//表单数量统计-待审批
     Route::get('getnot','SuperAdmin\SuperAdminController@getNotThrough');//表单数量统计未通过
     Route::get('getpass','SuperAdmin\SuperAdminController@getThrough'); //表单数量统计已通过
     Route::get('queryform','SuperAdmin\SuperAdminController@queryFormAll');//表单管理-表单审批-展示
     Route::get('formbox','SuperAdmin\SuperAdminController@formComboBox');//表单管理-表单审批-下拉框-状态
     Route::get('formsearch','SuperAdmin\SuperAdminController@formSearch');//表单管理-表单审批-下拉框-名称
     Route::post('termination','SuperAdmin\SuperAdminController@termination');//表单管理-表单审批-终止功能
     Route::get('formlook','SuperAdmin\SuperAdminController@formLook');//表单管理-表单审批-查看
     Route::post('judgepass','SuperAdmin\SuperAdminController@formJudgePass');//表单管理-表单审批-查看-审批-通过
     Route::post('judgenot','SuperAdmin\SuperAdminController@formJudgeNotPass');//表单管理-表单审批-查看-审批-不通过
     Route::post('notreason','SuperAdmin\SuperAdminController@formNotReason');//表单管理-表单审批-查看-审批-不通过的原因
     Route::get('formexport','SuperAdmin\SuperAdminController@formExport');//表单管理-表单审批-导出
     Route::get('eqsearch','SuperAdmin\SuperAdminController@equipmentSearch');//设备管理-设备归还-搜索框
     Route::get('eqshow','SuperAdmin\SuperAdminController@equipmentShow');//设备管理-设备归还-展示
     Route::get('eqlook','SuperAdmin\SuperAdminController@equipmentLook');//设备管理-设备归还-查看
     Route::post('eqreturn','SuperAdmin\SuperAdminController@equipmentReturn');//设备管理-设备归还-一个一个归还
     Route::post('eqreturnall','SuperAdmin\SuperAdminController@equipmentAllReturn');//设备管理-设备归还-全部归还
     Route::get('queryall','SuperAdmin\SuperAdminController@queryAllInventory');//设备管理-设备信息-展示
     Route::post('addin','SuperAdmin\SuperAdminController@addInventory');//设备管理-设备信息-增加
     Route::post('upin','SuperAdmin\SuperAdminController@updateInventory');//设备管理-设备信息-修改
     Route::post('dein','SuperAdmin\SuperAdminController@deleteInventory');//设备管理-设备信息-删除
});//yjx
