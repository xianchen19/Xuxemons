<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class evo_config extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'evo_config';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nivel',
        'required_chuches',
    ];

    public function xuxemons()
{
    return $this->hasMany(xuxemons::class);
}
}
