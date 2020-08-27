<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chacra extends Model
{
    protected $fillable =[
        
        'nombre',
        'area_km2',
        'tipo_cultiv',
        'zona',
        'imagen',
        'nombre_usu',
        'geom'
    ];
    public $timestamps = false;
}
