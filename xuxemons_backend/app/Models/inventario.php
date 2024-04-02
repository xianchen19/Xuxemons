<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inventario extends Model
{
    use HasFactory;
    protected $table = 'inventario';

    protected $fillable = ['nombre', 'tipo', 'cantidad', 'descripcion', 'imagen'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
