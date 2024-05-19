<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables.
     *
     * @var array
     */
    protected $fillable = ['userTag', 'friendTag', 'email', 'message'];

    /**
     * Los atributos que deberían ser visibles en los arrays.
     *
     * @var array
     */
    protected $visible = ['id', 'userTag', 'friendTag', 'email', 'message', 'created_at', 'updated_at'];

    /**
     * Definir la relación con el modelo User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'userTag', 'tag');
    }

    /**
     * Definir la relación con el modelo User para el amigo (friend).
     */
    public function friend()
    {
        return $this->belongsTo(User::class, 'friendTag', 'friend_tag');
    }
}
