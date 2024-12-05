<?php

namespace BolsaTrabajo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tickets extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id','vehiculo_id','tiempo_inicio','user_id','tiempo_fin','horas_servicio','monto','estado'
    ];

    public $timestamps = false;

    protected $dates = ['deleted_at'];

   // Modelo Tickets

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculos::class, 'vehiculo_id');
    }

    public function tipo()
    {
        return $this->belongsTo(Tipo::class, 'tipo_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
