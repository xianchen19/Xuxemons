<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class xuxemons extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'tipo', 'tamano', 'vida', 'archivo', 'enfermedades'];

    // Relación con usuarios
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('tamano');
    }

<<<<<<< HEAD
    // Alcance para filtrar xuxemons con una enfermedad específica
    public function scopeWithEnfermedad($query, $enfermedad)
    {
        return $query->where('enfermedades', $enfermedad);
=======
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('tamano');
>>>>>>> 36c47a0f9bea999d24e080a78e1e1e0bb8a2cbfb
    }
}
