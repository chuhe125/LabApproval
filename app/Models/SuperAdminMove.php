<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuperAdminMove extends Model
{
    //实验室运行表
    protected $table = "move";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];


//    /***
//     * 设备管理
//     * 搜索框
//     */
//    public static function yjx_equipmentSearch($request){
//        $id=$request['form_id'];
//        try {
//            $res = self::
//            join('form', 'form.id', '=', 'move.form_id')
//                ->where("form.id",$id)
//                ->select("id","form.form_name_id","student_name","created_at")->get();
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
//     public static function yjx_equipmentShow(){
//         try {
//             $res=self::selet('id','fotm_id','student_name','created_at')->get();
//             return $res?
//                 $res :
//                 false;
//         } catch (\Exception $e) {
//             logError('搜索错误', [$e->getMessage()]);
//             return false;
//         }
//     }
//    /***
//     * 设备管理
//     * 查看
//     */
//    public static function yjx_equipmentLook($request){
//        $id=$request['form_id'];
//        try {
//            $step1= self::
//            join('form', 'form.id', '=', 'move.form_id')
//                ->where("form.id",$id)
//                ->select("form.form_name_id")->value();
//            if ($step1==1){
//                $res=SuperAdminMove::select()->where('form_id',$step1)->get();
//            }elseif ($step1==2){
//                $res=SuperAdminBorrow::select()->where('form_id',$step1)->get();
//            }elseif ($step1==3){
//                $res=SuperAdminDevelop::select()->where('form_id',$step1)->get();
//            }else{
//                $res=SuperAdminEquipment::select()->where('form_id',$step1)->get();
//            }
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
//            join('form', 'form.id', '=', 'move.form_id')
//                ->where("form.id",$id)
//                ->update(
//                    [
//                        'form_state4'=>1
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
}
