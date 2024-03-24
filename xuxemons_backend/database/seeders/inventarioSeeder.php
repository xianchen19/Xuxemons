<?php

namespace Database\Seeders;

use App\Models\inventario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class inventarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $datos = [
            [
                'nombre' => 'Chuche 1',
                'tipo' => 'chuches',
                'cantidad' => 10,
                'descripcion' => 'Una deliciosa chuche de sabor a fresa.',
                'imagen' => 'chuche1.jpg',
            ],
            [
                'nombre' => 'Objeto 1',
                'tipo' => 'objeto',
                'cantidad' => 5,
                'descripcion' => 'Un objeto misterioso que brilla en la oscuridad.',
                'imagen' => 'objeto1.jpg',
            // Añade más datos si lo deseas
            ],
        ];

        // Insertar datos en la tabla correspondiente
        DB::table('inventario')->insert($datos);
    }
}
