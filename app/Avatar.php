<?php

namespace BolsaTrabajo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Avatar extends Model
{

    protected $table = 'avatars'; // Nombre de la tabla
    protected $fillable = ['file_name', 'name']; // Campos que se pueden llenar

    public $timestamps = false;


}
