<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\enfermedad;

class enfermedades extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Insertar datos de ejemplo para las enfermedades
        enfermedad::create([
            'porcentaje_bajon_azucar' => 5,
            'porcentaje_sobredosis_azucar' => 10,
            'porcentaje_atracon' => 15,
        ]);
    }
}
