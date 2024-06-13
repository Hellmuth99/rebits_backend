<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Model
{

    use HasFactory;
    protected $table = 'usuarios';


    protected $fillable = [
        'nombre',
        'apellidos',
        'correo',
        // Agrega otros atributos aquí si son necesarios
    ];
}
