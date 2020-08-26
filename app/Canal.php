<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Canal extends Model
{
    protected $table ='canales';
    protected $fillable =[
        'gid',
        'id',
        'nombre',
        'longitud',
        'zona',
        'imagen',
        'valv_i',
        'valv_f',
        'geom'
    ];
    public $timestamps = false;
}
