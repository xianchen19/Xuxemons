<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class xuxemons extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'tipo', 'tamano', 'vida', 'archivo', 'bajon_azucar', 'sobredosis_azucar', 'atracon'];

    // Relación con usuarios
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('tamano');
    }

    // Alcance para filtrar xuxemons con una enfermedad específica
    public function scopeWithEnfermedad($query, $enfermedad)
    {
        return $query->where('enfermedades', $enfermedad);
    }
}
