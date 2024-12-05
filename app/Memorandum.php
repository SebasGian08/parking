<?php

namespace BolsaTrabajo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Memorandum extends Model
{
    protected $table = 'memorandum'; // Nombre de la tabla
    use SoftDeletes;

    protected $fillable = [
        'dni','nombres','logo','asunto','created_at'
    ];

    public $timestamps = false;

    protected $dates = ['deleted_at'];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'dni', 'dni'); // Ajusta los parámetros según tu esquema
    }
}
