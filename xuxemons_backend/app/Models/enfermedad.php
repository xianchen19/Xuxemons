<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class enfermedad extends Model
{
    use HasFactory;

    protected $table = 'enfermedades'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'porcentaje_bajon_azucar',
        'porcentaje_sobredosis_azucar',
        'porcentaje_atracon',
        'xuxesBajon'
    ];

}
