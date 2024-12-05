<?php

namespace BolsaTrabajo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Planes extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'codigo','nombre', 'tiempo', 'precio', 'observaciones', 'estado'
    ];

    public $timestamps = false;

    protected $dates = ['deleted_at'];


}
