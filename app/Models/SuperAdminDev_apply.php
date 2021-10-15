<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuperAdminDev_apply extends Model
{
    //开发实验室表-附表
    protected $table = "dvp_apply";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];
}
