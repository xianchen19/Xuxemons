<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class xuxemons extends Model
{
    use HasFactory;

    protected $fillable = ['imagen', 'nombre', 'tipo', 'tamaño', 'vida', 'archivo'];

}
