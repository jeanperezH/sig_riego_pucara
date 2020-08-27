<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Valvula extends Model
{
    protected $fillable =[
        
        'gid',
        'id',
        'nombre',
        'hora_inici',
        'hora_final',
        'zona',
        'utmx',
        'utmy',
        'imagen',
        'geom'
    ];
    public $timestamps = false;
}
