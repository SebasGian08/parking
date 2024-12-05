<?php

namespace BolsaTrabajo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Horario extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id','ingreso','salida'
    ];

    public $timestamps = false;

    protected $dates = ['deleted_at'];
}
