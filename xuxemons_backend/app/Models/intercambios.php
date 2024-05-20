<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class intercambios extends Model
{
    use HasFactory;

    protected $fillable = ['user_tag', 'friend_tag', 'xuxemon_id', 'status'];



    public function users()
    {
        return $this->belongsToMany(User::class, 'amigos', 'friend_tag', 'user_tag')
            ->withPivot('status')
            ->withTimestamps();
    }
}

