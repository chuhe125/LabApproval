<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuperAdminBorrow extends Model
{
    //实验室借用表
    protected $table = "borrow";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];}
//    /***
//     * 设备管理
//     * 搜索框
//     */
//    public static function yjx_equipmentSearch($request){
//        $id=$request['form_id'];
//        try {
//            $res = self::select('id','form_id','borrow_applicant','borrow_date')->where('form_id',$id)->get();
//            return $res ?
//                $res :
//                false;
//        } catch (\Exception $e) {
//            logError('搜索错误', [$e->getMessage()]);
//            return false;
//        }
//    }
//    /***
//     * 设备管理
//     * 展示
//     */
//    public static function yjx_equipmentShow(){
//        try {
//            $res=self::select("id","form_id","borrow_applicant","borrow_date")->get();
//            return $res?
//                $res :
//                false;
//        } catch (\Exception $e) {
//            logError('搜索错误', [$e->getMessage()]);
//            return false;
//        }
//    }
//    /***
//     * 设备管理
//     * 查看
//     */
//    public static function yjx_equipmentLook($request){
//        $id=$request['form_id'];
//        try {
//            $res= self::select()->where('form_id',$id)->get();
//            return $res?
//                $res :
//                false;
//        } catch (\Exception $e) {
//            logError('搜索错误', [$e->getMessage()]);
//            return false;
//        }
//    }
//    /***
//     * 设备管理
//     * 归还
//     */
//    public static function yjx_equipmentReturn($request){
//        $id=$request['form_id'];
//        try {
//            $res= self::
//            join('form', 'form.id', '=', 'borrow.form_id')
//                ->where("form.id",$id)
//                ->update(
//                    [
//                        'form.form_state4'=>1
//                    ]
//                );
//            return $res?
//                $res :
//                false;
//        } catch (\Exception $e) {
//            logError('搜索错误', [$e->getMessage()]);
//            return false;
//        }
//    }
//}















