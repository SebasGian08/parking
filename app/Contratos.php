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


    // Contrato.php
    public function abonado()
    {
        return $this->belongsTo(Abonados::class, 'abonado_id');
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculos::class, 'vehiculo_id');
    }

    public function plan()
    {
        return $this->belongsTo(Planes::class, 'plan_id');
    }

    public function estacionamiento()
    {
        return $this->belongsTo(Estacionamiento::class, 'estacionamiento_id');
    }

}
