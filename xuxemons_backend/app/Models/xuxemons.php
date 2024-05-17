<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class xuxemons extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'tipo', 'tamano', 'vida', 'archivo', 'enfermedades'];

    // Relación con usuarios
    /*
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('tamano');
    }*/
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_xuxemons', 'xuxemons_id', 'user_id')->withPivot('tamano');
    }

    // Alcance para filtrar xuxemons con una enfermedad específica
    public function scopeWithEnfermedad($query, $enfermedad)
    {
        return $query->where('enfermedades', $enfermedad);
    }
}
