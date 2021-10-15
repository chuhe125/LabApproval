<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuperAdminInventory extends Model
{
    //库存表
    protected $table = "instrument";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];


    /***
     * 设备管理
     * 设备信息-展示
     */
    public static function yjx_queryAllInventory(){
        try {
            $res = self::select()->get();
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }

    /***
     * 设备管理
     * 设备信息-增加
     */
     public static function yjx_addInventory($request){
         try {
             $res = self::create(
                 [
                     'instrument_name'=>$request['instrument_name'],
                     'instrument_model'=>$request['instrument_model'],
                     'instrument_tatal'=>$request['instrument_tatal'],
                     'instrument_quantity'=>$request['instrument_tatal']
                 ]
             );
             return $res ?
                 $res :
                 false;
         } catch (\Exception $e) {
             logError('搜索错误', [$e->getMessage()]);
             return false;
         }
     }

    /***
     * 设备管理
     * 设备信息-修改
     */
    public static function yjx_updateInventory($request){
        try {
            $instrument_quantity=$request['instrument_tatal']-$request['instrument_quantityBorrow'];
            $res = self::where( 'id',$request['id'])->update(
                [
                    'instrument_name'=>$request['instrument_name'],
                    'instrument_model'=>$request['instrument_model'],
                    'instrument_tatal'=>$request['instrument_tatal'],
                    'instrument_quantity'=>$instrument_quantity
                ]
            );
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    /***
     * 设备管理
     * 设备信息-删除
     */
    public static function yjx_deleteInventory($request){

        try {
            $res = self::where('id',$request['id'])->delete();
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }



}
