<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuperAdminEqp_equipment extends Model
{
    //
    //开发实验室表-附表
    protected $table = "eqp_equipment";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

//    public static function yjx_test($res3)
//    {
//        try {
//            for($i=0;$i<count($res3);$i++) {
//                $res[$i] = self::
//                join('instrument', 'instrument.id', '=', 'eqp_equipment.instrument.id')
//                    ->where("instrument.id", $res3[$i])
//                    ->select('instrument.instrument_name', 'instrument.instrument_model',
//                        'eqp_equipment.eqp_equipment_quantity', 'eqp_equipment.eqp_equipment_enclosure')->get();
//            }
//            return $res ?
//                $res :
//                false;
//        } catch (\Exception $e) {
//            logError('搜索错误', [$e->getMessage()]);
//            return false;
//        }
//    }
}

