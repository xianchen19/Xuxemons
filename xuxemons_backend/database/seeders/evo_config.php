<?php

namespace Database\Seeders;

use App\Models\evo_config as EvolutionConfig;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class evo_config extends Seeder
{
    /**
     * Run the database seeds.
     */  
    public function run()
    {
        EvolutionConfig::create([
            'nivel' => 1,
            'required_chuches' => 3,
<<<<<<< HEAD
            'chuches_diarias'=>10,
=======
>>>>>>> 36c47a0f9bea999d24e080a78e1e1e0bb8a2cbfb
        ]);

        EvolutionConfig::create([
            'nivel' => 2,
            'required_chuches' => 5,
<<<<<<< HEAD
            'chuches_diarias'=>10,
=======
>>>>>>> 36c47a0f9bea999d24e080a78e1e1e0bb8a2cbfb
        ]);
    }

}

