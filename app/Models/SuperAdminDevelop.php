<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuperAdminDevelop extends Model
{
    //开发实验室表
    protected $table = "development";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];
}
