<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\inventario;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'monedas',
    ];

    /**  * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
       /**
     * Define the relationship between User and Xuxemons.
     */
 /*
     public function xuxemons()
     {
         return $this->belongsToMany(xuxemons::class)->withPivot('tamano');
     }*/
     public function xuxemons()
    {
        return $this->belongsToMany(Xuxemons::class, 'user_xuxemons', 'user_id', 'xuxemons_id')->withPivot('tamano', 'activo');
    }
     public function inventario()
     {
         return $this->hasMany(Inventario::class);
     }

     public function xuxemonsActivos()
    {
    return $this->belongsToMany(Xuxemons::class)->withPivot('tamano')->wherePivot('activo', true)->limit(4);
    }

    public function amigos()
    {
        return $this->belongsToMany(User::class, 'amigos', 'user_tag', 'friend_tag')
            ->withPivot('status')
            ->withTimestamps();
    }
    public function solicitudesAmistad()
{
    return $this->belongsToMany(User::class, 'amigos', 'friend_tag', 'user_tag')
        ->withPivot('status')
        ->wherePivot('status', 'pendiente');
}
    
}
