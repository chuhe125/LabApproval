<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuperAdminFormName extends Model
{
    //
    protected $table = "form_name";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];
}
