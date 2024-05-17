<?php

namespace Database\Seeders;

use App\Models\user_xuxemons;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class coleccion extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        user_xuxemons::create([
            'user_id' => 1,
            'xuxemons_id' => 1,
            'activo'=> 1,
        ]);
        user_xuxemons::create([
            'user_id' => 1,
            'xuxemons_id' => 2,
            'activo'=> 1,
        ]);
        user_xuxemons::create([
            'user_id' => 1,
            'xuxemons_id' => 3,
            'activo'=> 1,
        ]);
        user_xuxemons::create([
            'user_id' => 1,
            'xuxemons_id' => 4,
            'activo'=> 1,
        ]);
        user_xuxemons::create([
            'user_id' => 1,
            'xuxemons_id' => 5,
            'activo'=> 0,
        ]);
    }
}
