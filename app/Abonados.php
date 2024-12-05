<?php

namespace BolsaTrabajo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Abonados extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'tipo_doc','num_doc', 'razon_social', 'direccion', 'tel', 'email', 'observaciones', 'estado'
    ];

    public $timestamps = false;

    protected $dates = ['deleted_at'];

    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_doc', 'id');
    }

}
