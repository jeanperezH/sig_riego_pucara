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
        'valvula_in',
        'geom'
    ];
    public $timestamps = false;
}
