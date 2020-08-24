<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    protected $fillable =[
        
        'zona',
        'descripcion'
    ];
    public $timestamps = false;
}
