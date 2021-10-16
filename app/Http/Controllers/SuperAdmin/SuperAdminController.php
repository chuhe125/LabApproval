<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\addInventoryRequest;
use App\Http\Requests\deleteInventoryRequest;
use App\Http\Requests\equipmentLookRequest;
use App\Http\Requests\equipmentReturnRequest;
use App\Http\Requests\equipmentSearchRequest;
use App\Http\Requests\formComboBoxRequest;
use App\Http\Requests\formExportRequest;
use App\Http\Requests\formJudgeNotPassRequest;
use App\Http\Requests\formJudgePassRequest;
use App\Http\Requests\formLookRequest;
use App\Http\Requests\formNotReasonRequest;
use App\Http\Requests\formSearchRequest;
use App\Http\Requests\terminationRequest;
use App\Http\Requests\updateInventoryRequest;
use App\Models\SuperAdminBorrow;
use App\Models\SuperAdminEquipment;
use App\Models\SuperAdminMove;
use App\Models\SuperAdminForm;
use App\Models\SuperAdminInventory;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    /***
     * 表单管理
     * 表单数量
     */
    //表单数量统计-总数
    public function getCount(){
        $res =SuperAdminForm::yjx_getCount();
        return $res ?
            json_success('查询成功!', $res, 200) :
            json_fail('查询失败!', null, 100);
    }
    //表单数量统计-待审批
    public function  getPending(){
        $res =SuperAdminForm::yjx_getPending();
        return $res ?
            json_success('查询成功!', $res, 200) :
            json_fail('查询失败!', null, 100);
    }
    //表单数量统计-未通过
    public function getNotThrough(){
        $res =SuperAdminForm::yjx_getNotThrough();
        return $res ?
            json_success('查询成功!', $res, 200) :
            json_fail('查询失败!', null, 100);
    }

    //表单数量统计-已通过
    public  function getThrough(){
        $res =SuperAdminForm::yjx_getThrough();
        return $res ?
            json_success('查询成功!', $res, 200) :
            json_fail('查询失败!', null, 100);
    }
    /***
     * 表单管理
     * 表单审批
     */
     //展示信息
    public function queryFormAll(){
        $res= $res=SuperAdminForm::yjx_getFormAll();;
        return $res ?
            json_success('查找成功!', $res, 200) :
            json_fail('查找失败!', null, 100);
    }
    //下拉框查询
    public function  formComboBox(formComboBoxRequest  $request){
        if ($request['state']==0){
            $res=SuperAdminForm::yjx_getFormComboBoxP();
        }
        elseif ($request['state']==2){
            $res=SuperAdminForm::yjx_getFormComboBoxYes();
        }
        elseif($request['state']==1){
            $res=SuperAdminForm::yjx_getFormComboBoxNot();
        }else{
            $res=SuperAdminForm::yjx_getFormAll();
        }
        return $res ?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }
    //搜索框
    public function formSearch(formSearchRequest  $request){
        $res=SuperAdminForm::yjx_getSearch($request);
        return $res ?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }
    //终止
    public function termination(terminationRequest $request){
        $res=SuperAdminForm::yjx_termination($request);
        return $res ?
            json_success('终止成功!', null, 200) :
            json_fail('终止失败!', null, 100);
    }
    //查看
    public function formLook(formLookRequest $request){
        $res=SuperAdminForm::yjx_lookForm($request);
        return $res ?
            json_success('查看成功!', $res, 200) :
            json_fail('查看失败!', null, 100);
    }
    //查看后是否通过  --通过
    public function formJudgePass(formJudgePassRequest $request){
        $res=SuperAdminForm::yjx_formJudgePass($request);
        return $res ?
            json_success('操作成功!', null, 200) :
            json_fail('操作失败!', null, 100);
    }
    //查看后是否通过  --不通过
    public function formJudgeNotPass(formJudgeNotPassRequest $request){
        $res=SuperAdminForm::yjx_formJudgeNotPass($request);
        return $res ?
            json_success('操作成功!', null, 200) :
            json_fail('操作失败!', null, 100);
    }
    //查看后不通过的原因
    //--传入字段-id --form_reason
    public function formNotReason(formNotReasonRequest  $request){
        $res =SuperAdminForm::yjx_formNotReason($request);
        return $res ?
            json_success('操作成功!', null, 200) :
            json_fail('操作失败!', null, 100);
    }
    //导出
   public function formExport(formExportRequest $request){
       $res=SuperAdminForm::yjx_formExport($request);
       return $res ?
           json_success('导出成功!', $res, 200) :
           json_fail('导出失败!', null, 100);
   }
   /***
    * 设备管理
    * 设备归还-搜索框
    */
   public function equipmentSearch(equipmentSearchRequest $request){
       $res=SuperAdminEquipment::yjx_equipmentSearch($request);
       return $res ?
           json_success('操作成功!', $res, 200) :
           json_fail('操作失败!', null, 100);
   }
    /***
     * 设备管理
     * 设备归还-展示
     */
    public function equipmentShow(){
        $res=SuperAdminEquipment::yjx_equipmentShow();
        return $res ?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }





    /***
     * 设备管理
     * 设备归还-查看
     */
    public function  equipmentLook(equipmentLookRequest $request){
        $res=SuperAdminEquipment::yjx_equipmentLook($request);
        return $res ?
            json_success('操作成功!', $res, 200) :
            json_fail('操作失败!', null, 100);
    }
    /***
     * 设备管理
     *设备归还- 一个一个归还
     */
    public function  equipmentReturn(equipmentReturnRequest $resquest){
        $res=SuperAdminEquipment::yjx_equipmentReturn($resquest);
        return $res ?
            json_success('归还成功!', null, 200) :
            json_fail('归还失败!', null, 100);
    }
    /***
     * 设备管理
     *设备归还- 全部归还
     */
    public function  equipmentAllReturn(equipmentReturnRequest $resquest){
        $res=SuperAdminEquipment::yjx_equipmentAllReturn($resquest);
        return $res ?
            json_success('归还成功!', null, 200) :
            json_fail('归还失败!', null, 100);
    }


    /***
     * 设备管理
     * 设备信息-展示
     */
     public function queryAllInventory(){
         $res=SuperAdminInventory::yjx_queryAllInventory();
         return $res ?
             json_success('查找成功!', $res, 200) :
             json_fail('查找失败!', null, 100);
     }

    /***
     * 设备管理
     * 设备信息-增加
     */
     public function addInventory(addInventoryRequest $request){
         $res=SuperAdminInventory::yjx_addInventory($request);
         return $res ?
             json_success('增加成功!', null, 200) :
             json_fail('增加失败!', null, 100);
     }


    /***
     * 设备管理
     * 设备信息-修改
     */
    public function updateInventory(updateInventoryRequest $request){
        $res=SuperAdminInventory::yjx_updateInventory($request);
        return $res ?
            json_success('修改成功!', null, 200) :
            json_fail('修改失败!', null, 100);
    }


    /***
     * 设备管理
     * 设备信息-删除
     */
    public function deleteInventory(deleteInventoryRequest $request){
        $res=SuperAdminInventory::yjx_deleteInventory($request);
        return $res ?
            json_success('删除成功!', null, 200) :
            json_fail('删除失败!', null, 100);
    }

}
