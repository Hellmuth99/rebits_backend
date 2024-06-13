<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehiculo extends Model
{
    use HasFactory;


    protected $fillable = [
        'marca',
        'modelo',
        'patente',
        'anio',
        'precio',
        'dueno_id',
        // Agrega otros atributos aquí si son necesarios
    ];
}
