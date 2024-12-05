<?php

namespace BolsaTrabajo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Extras extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id','dni','horas','minutos','documento','estado'
    ];

    public $timestamps = false;

    protected $dates = ['deleted_at'];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'dni', 'dni'); // Asegúrate de que 'dni' es la clave foránea y en 'Empleado' también
    }



}
