<?php

namespace BolsaTrabajo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Asistencia extends Model
    {
        use SoftDeletes;

        protected $fillable = [
            'id','dni','tipo_id','hora_entrada','hora_salida','total_horas','created_at'
        ];
    
        public $timestamps = false;
    
        protected $dates = ['deleted_at'];
    
        public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'dni'); // Asegúrate de que 'empleado_id' sea el nombre correcto de la columna
    }
            
    }