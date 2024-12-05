<?php

namespace BolsaTrabajo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Vehiculos extends Model
{

    protected $table = 'vehiculos';
    protected $primaryKey = 'id';
    public $timestamps = false; // Si no tienes timestamps en tu tabla programas
    /* SoftDeletes, esto sirve para dar un mantenimiento a la base de datos saber cuando sea editado o eliminado */
    use SoftDeletes;
        protected $fillable = [
            'id',
            'placa',
            'tipo_id',
            'modelo',
            'marca',
            'color',
            'observaciones',
            'estado'


        ];
        
        public function tipo()
        {
            return $this->belongsTo(Tipo::class, 'tipo_id');
        }
      
    
}
