<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rio extends Model
{
    protected $fillable =[
        
        'gid',
        'id',
        'nombre',
        'tipo_rio',
        'longitud_m',
        'imagen',
        'zona',
        'geom'
    ];
    public $timestamps = false;
}
