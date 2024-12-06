<?php

namespace BolsaTrabajo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contratos extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'abonado_id','vehiculo_id','plan_id','fecha_inicio','fecha_fin','estacionamiento_id','nota'
    ];

    public $timestamps = false;

    protected $dates = ['deleted_at'];
}
