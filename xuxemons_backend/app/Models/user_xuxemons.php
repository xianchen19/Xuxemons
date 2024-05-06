<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_xuxemons extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id', 'xuxemons_id', 'tamano','activo'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación con el modelo Xuxemons
    public function xuxemons()
    {
        return $this->belongsTo(Xuxemons::class, 'xuxemons_id');
    }
}
