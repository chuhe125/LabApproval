<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuperAdminEquipment extends Model
{
    // 设备借用表
    protected $table = "equipment";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];
    /***
     * 设备管理
     * 搜索框
     */
    public static function yjx_equipmentSearch($request){
        $id=$request['id'];
        try {
            $res1= self::select("id","student_name","equipment_time1")->where('id',$id)->get();
            $step=self::where('id',$id)->value('form_id');
            $step2=SuperAdminForm::where('id',$step)->value('form_name_id');
            $res2=SuperAdminFormName::select('form_name')->where('id',$step2)->get();
            $res['res1']=$res1;
            $res['res2']=$res2;
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
     * 展示
     */
    public static function yjx_equipmentShow(){
        try {
            $res=self::select("id","student_name","equipment_time1")->get();
//            $res=self::join('form','form.id','=','form_id')
//                ->select("id","form.form_name_id","student_name","equipment_time1")
//                ->get();

            return $res?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    /***
     * 设备管理
     * 查看
     */
    public static function yjx_equipmentLook($request){
        $id=$request['id'];
        try {
            $res3=SuperAdminEqp_equipment::where('equipment_id',$id)->pluck('instrument_id');
            for($i=0;$i<count($res3);$i++){
                $res[$i]=SuperAdminEqp_equipment::
                join('instrument', 'instrument.id', '=', 'instrument_id')
                    ->where("instrument.id",$res3[$i])
                    ->where('equipment_id',$id)
                    ->select('instrument.id','instrument.instrument_name','instrument.instrument_model',
                        'eqp_equipment_quantity','eqp_equipment_enclosure')->get();
            }
            return $res?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    /***
     * 设备管理
     * 一个一个归还
     */
    public static function yjx_equipmentReturn($request){
        $id=$request['id'];
        try {
            $step1= SuperAdminEqp_equipment::
            join('instrument', 'instrument.id', '=', 'instrument_id')
                ->where("instrument.id",$id)
//                ->where('instrument_id',"instrument.id")
                ->value('eqp_equipment_quantity');

            $step2=SuperAdminInventory::where('id',$id)->value('instrument_quantity');
            $step3=$step1+$step2;
            $step4=SuperAdminEqp_equipment::where('instrument_id',$id)->delete();
            $res=SuperAdminInventory::where('id',$id)
                ->update([
                    'instrument_quantity'=>$step3
                ]);
            return $res?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    /***
     * 设备管理
     * 一个一个归还
     */
    public static function yjx_equipmentAllReturn($request){
        try {
//            dd($request['id']);
            $a=count($request['id']);
            for ($i=0;$i<$a;$i++){
//                dd($request['id'][$i]);
                $step1= SuperAdminEqp_equipment::
                join('instrument', 'instrument.id', '=', 'instrument_id')
                    ->where("instrument.id",$request['id'][$i])
//                ->where('instrument_id',"instrument.id")
                    ->value('eqp_equipment_quantity');
                $step2=SuperAdminInventory::where('id',$request['id'][$i])->value('instrument_quantity');
                $step3=$step1+$step2;
                $step4=SuperAdminEqp_equipment::where('instrument_id',$request['id'][$i])->delete();
                $res=SuperAdminInventory::where('id',$request['id'][$i])
                    ->update([
                        'instrument_quantity'=>$step3
                    ]);
            };

        return $res?
            $res :
            false;
    } catch (\Exception $e) {
         logError('搜索错误', [$e->getMessage()]);
            return false;
           }
    }
}
