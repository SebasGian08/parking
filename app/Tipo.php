<?php

namespace BolsaTrabajo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tipo extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nombre','montoxhora','montoxfraccion','descripcion'
    ];

    public $timestamps = false;

    protected $dates = ['deleted_at'];

    public function vehiculos()
    {
        return $this->hasMany(Vehiculos::class, 'tipo_id');
    }

}
