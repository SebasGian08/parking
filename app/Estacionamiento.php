<?php

namespace BolsaTrabajo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Estacionamiento extends Model
{

    protected $table = 'estacionamientos';
    protected $primaryKey = 'id';
    public $timestamps = false; // Si no tienes timestamps en tu tabla programas
    /* SoftDeletes, esto sirve para dar un mantenimiento a la base de datos saber cuando sea editado o eliminado */
    use SoftDeletes;
        protected $fillable = [
            'id',
            'nombre',
            'codigo',
            'numero',
            'piso',
            'id_user',
            'observaciones',
            'estado'


        ];
        
    /* public function participantes()
    {
        return $this->hasMany(Participantes::class, 'id_programa', 'id');
    } */
      
    
}
