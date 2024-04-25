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
                'cantidad' => 100,
                'descripcion' => 'Una deliciosa chuche de sabor a fresa.',
                'imagen' => 'chuche1.jpg',
                'user_id'=>'1',
            ],
            [
                'nombre' => 'Xocolatina',
                'tipo' => 'objeto',
                'cantidad' => 10,
                'descripcion' => 'Objeto que se almacena en la mochila y al usarlo en un Xuxemon quita “Bajón de azúcar”',
                'imagen' => 'xocolatina.jpg',
                'user_id'=> '1',
            ],
            [
                'nombre' => 'Inxulina',
                'tipo' => 'objeto',
                'cantidad' => 10,
                'descripcion' => 'Objeto que se almacena en la mochila y al usarlo en un Xuxemon quita “Sobredosis de azúcar”',
                'imagen' => 'xocolatina.jpg',
                'user_id'=> '1',
            ],
            [
                'nombre' => 'Xal de frutas',
                'tipo' => 'objeto',
                'cantidad' => 10,
                'descripcion' => 'Objeto que se almacena en la mochila y al usarlo en un Xuxemon quita “Atracón”',
                'imagen' => 'xocolatina.jpg',
                'user_id'=> '1',
            ],
        ];

        // Insertar datos en la tabla correspondiente
        DB::table('inventario')->insert($datos);
    }
}
