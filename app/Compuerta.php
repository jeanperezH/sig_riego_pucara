<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compuerta extends Model
{
    protected $fillable =[
        
        'id_zona',
        'compuerta',
        'start_at',
        'end_at',
        'dias'
    ];
    public $timestamps = false;
}
