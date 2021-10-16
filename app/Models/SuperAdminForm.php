<?php

namespace App\Models;

use Illuminate\Database\Console\Migrations\FreshCommand;
use Illuminate\Database\Eloquent\Model;

class SuperAdminForm extends Model
{
    //form 表
    protected $table = "form";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    /***
     * 表单数量统计-总数
     */
    public static function yjx_getCount(){
        try {
            $res =self::select()->count();
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }

    /***
     * 表单数量统计-待审批
     */
    public static function  yjx_getPending(){
        try {
            $res1 = self::select("form_state1","form_state2","form_state3")
                ->where("form_state1",0)->count();
            $res2 = self::select("form_state1","form_state2","form_state3")
                ->where("form_state1",2)->where("form_state2",0)->count();
            $res3 = self::select("form_state1","form_state2","form_state3")
                ->where("form_state1",2)->where("form_state2",2)->where("form_state3",0)->count();
            $res=$res1+$res2+$res3;
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }

    /***
     * 表单数量统计-未通过
     */
    public static function yjx_getNotThrough(){
        try {
            $res1 = self::select("form_state1","form_state2","form_state3")
                ->where("form_state1",1)->count();
            $res2 = self::select("form_state1","form_state2","form_state3")
                ->where("form_state1",2)->where("form_state2",1)->count();
            $res3 = self::select("form_state1","form_state2","form_state3")
                ->where("form_state1",2)->where("form_state2",2)->where("form_state3",1)->count();
            $res=$res1+$res2+$res3;
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }

    /***
     * 表单数量统计-已通过
     */
    public static function yjx_getThrough(){
        try {
            $res = self::select("form_state1","form_state2","form_state3")
                ->where("form_state3",2)->count();
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    /***
     * 表单审批-下拉框-未通过
     */
    public static function yjx_getFormComboBoxNot(){
        try {
            $res1= self::select("id","form_name_id","created_at","form_state1","form_state2","form_state3")
                ->where("form_state1",1)->get();
            $res2= self::select("id","form_name_id","created_at","form_state1","form_state2","form_state3")
                ->where("form_state1",2)->where("form_state2",1)->get();
            $res3 = self::select("id","form_name_id","created_at","form_state1","form_state2","form_state3")
                ->where("form_state1",2)->where("form_state2",2)->where("form_state3",1)->get();
            $res['res1']=$res1;
            $res['res2']=$res2;
            $res['res3']=$res3;
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    /***
     * 表单审批-下拉框-已通过
     */
    public static function yjx_getFormComboBoxYes(){
        try {
            $res= self::select("id","form_name_id","created_at","form_state1","form_state2","form_state3")
                ->where("form_state3",2)->get();
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    /***
     * 表单审批-下拉框-待审批
     */
    public static function yjx_getFormComboBoxP(){
        try {
            $res1 = self::select("id","form_name_id","created_at","form_state1","form_state2","form_state3")
                ->where("form_state1",0)->get();
            $res2 = self::select("id","form_name_id","created_at","form_state1","form_state2","form_state3")
                ->where("form_state1",2)->where("form_state2",0)->get();
            $res3 = self::select("id","form_name_id","created_at","form_state1","form_state2","form_state3")
                ->where("form_state1",2)->where("form_state2",2)->where("form_state3",0)->get();;
            $res['res1']=$res1;
            $res['res2']=$res2;
            $res['res3']=$res3;
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    /***
     * 表单审批-下拉框-全部
     */
    public static function yjx_getFormAll(){
        try {
            $res = self::select("id","form_name_id","created_at","form_state1","form_state2","form_state3")->get();
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    /***
     * 表单审批-搜索框
     * 通过表单名称
     */
    public static function yjx_getSearch($request){
        $form_id=$request['form_name_id'];
        try {
            $res = self::select("id","form_name_id","created_at","form_state1","form_state2","form_state3")
                ->where("form_name_id",$form_id)->get();
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    /***
     *表单审批-操作
     * 终止
     */
    public static function yjx_termination($request){
        $id=$request['id'];
        try {
            $res = self::where("id",$id)
                ->update(
                    [
                'form_state5'=>1
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
     *表单审批-操作
     * 查看
     */
    public static function yjx_lookForm($request){
        $step1=$request['form_name_id'];
        $step2=$request['id'];
        try {
                if ($step1==1){
                    $res=SuperAdminMove::select("id", "move_week", "move_class", "student_name",
                "move_people", "move_name", "move_type", "move_teacher", "move_move", "move_remarks"
                )->where('form_id',$step2)->get();
                }elseif ($step1==2){
                    $res=SuperAdminBorrow::select( "borrow_date", "borrow_name", "borrow_number", "borrow_course",
                "borrow_class", "borrow_objective", "borrow_time1", "borrow_time2", "borrow_promise",
                        "borrow_applicant", "borrow_telephone"
    )->where('form_id',$step2)->get();
                }elseif ($step1==3){
                    $res1=SuperAdminDevelop::select("development_reason1", "development_name",
                    "development_time1", "development_time2", "development_applicant")->where('form_id',$step2)->get();
                    $res2=SuperAdminDevelop::where('form_id',$step2)->value('id');
                    $res3=SuperAdminDev_apply::select("student_name", "student_job_number",
                    "student_phone", "undertake_work")->where('development_id',$res2)->get();
                    $res['res1']=$res1;
                    $res['res2']=$res3;
                }else{
                    $res1=SuperAdminEquipment::select("equipment_department", "equipment_purpose",
                "equipment_time1", "equipment_time2", "student_name", "student_phone")->where('form_id',$step2)->get();
    //                dd($res1);
                    $res2=SuperAdminEquipment::where('form_id',$step2)->value('id');

                    $res3=SuperAdminEqp_equipment::where('equipment_id',$res2)->pluck('instrument_id');
                    for($i=0;$i<count($res3);$i++){
                        $res4[$i]=SuperAdminEqp_equipment::
                        join('instrument', 'instrument.id', '=', 'instrument_id')
                            ->where("instrument.id",$res3[$i])
                            ->where('equipment_id',$res2)
                            ->select('instrument.instrument_name','instrument.instrument_model',
                                'eqp_equipment_quantity','eqp_equipment_enclosure')->get();
                    }

                    $res['res1']=$res1;
                    $res['res2']=$res4;

            }

            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    /***
     *表单审批-操作
     * 查看后的审批--通过
     */
    public static function yjx_formJudgePass($request){
        try {
          $res=self::where('id',$request['id'])->update(
              [
                  'form_state5'=>2
              ]);
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    /***
     *表单审批-操作
     * 查看后的审批--不通过
     */
    public static function yjx_formJudgeNotPass($request){
        try {
            $res=self::where('id',$request['id'])->update(
                [
                    'form_state5'=>1
                ]);
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    /***
     *表单审批-操作
     * 查看后的审批--不通过的原因
     */
    public static function yjx_formNotReason($request){
        try {
            $res=self::where('id',$request['id'])->update(
                [
                    'form_reason'=>$request['form_reason']
                ]);
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }

    /***
     *表单审批-操作
     * 导出
     */
    public static function yjx_formExport($request){
            $step1=$request['form_name_id'];
            $step2=$request['id'];
            try {
                if ($step1==1){
                    $res=SuperAdminMove::select("id", "move_week", "move_class", "student_name",
                        "move_people", "move_name", "move_type", "move_teacher", "move_move", "move_remarks"
                    )->where('form_id',$step2)->get();
                }elseif ($step1==2){
                    $res=SuperAdminBorrow::select( "borrow_date", "borrow_name", "borrow_number", "borrow_course",
                        "borrow_class", "borrow_objective", "borrow_time1", "borrow_time2", "borrow_promise",
                        "borrow_applicant", "borrow_telephone"
                    )->where('form_id',$step2)->get();
                }elseif ($step1==3){
                    $res1=SuperAdminDevelop::select("development_reason1", "development_name",
                        "development_time1", "development_time2", "development_applicant")->where('form_id',$step2)->get();
                    $res2=SuperAdminDevelop::where('form_id',$step2)->value('id');
                    $res3=SuperAdminDev_apply::select("student_name", "student_job_number",
                        "student_phone", "undertake_work")->where('development_id',$res2)->get();
                    $res['res1']=$res1;
                    $res['res2']=$res3;
                }else{
                    $res1=SuperAdminEquipment::select("equipment_department", "equipment_purpose",
                        "equipment_time1", "equipment_time2", "student_name", "student_phone")->where('form_id',$step2)->get();
                    //                dd($res1);
                    $res2=SuperAdminEquipment::where('form_id',$step2)->value('id');

                    $res3=SuperAdminEqp_equipment::where('equipment_id',$res2)->pluck('instrument_id');
                    for($i=0;$i<count($res3);$i++){
                        $res4[$i]=SuperAdminEqp_equipment::
                        join('instrument', 'instrument.id', '=', 'instrument_id')
                            ->where("instrument.id",$res3[$i])
                            ->where('equipment_id',$res2)
                            ->select('instrument.instrument_name','instrument.instrument_model',
                                'eqp_equipment_quantity','eqp_equipment_enclosure')->get();
                    }

                    $res['res1']=$res1;
                    $res['res2']=$res4;
                }
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
}
