<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rio extends Model
{
    protected $fillable =[
        
        'gid',
        'id',
        'nombre_rio',
        'tipo_rio',
        'longitud_m',
        'imagen',
        'zona',
        'geom'
    ];
    public $timestamps = false;
}
