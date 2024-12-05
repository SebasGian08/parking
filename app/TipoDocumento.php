<?php

namespace BolsaTrabajo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoDocumento extends Model
{
    use SoftDeletes;
    protected $table = 'tipodocumento';

    protected $fillable = [
        'Nombre'
    ];

    public $timestamps = false;

    protected $dates = ['deleted_at'];



}
