<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\xuxemons;

class xuxemonSeeder extends Seeder
{
    public function run()
    {
        $xuxemons = [
['nombre' => 'Apleki', 'tipo' => 'Tierra', 'tamano' => 'pequeño','archivo' => 'apleki.png', 'nivel' => 1],
['nombre' => 'Avecrem', 'tipo' => 'Aire', 'tamano' => 'pequeño', 'archivo' => 'avecrem.png', 'nivel' => 1],
['nombre' => 'Bambino', 'tipo' => 'Tierra', 'tamano' => 'pequeño', 'archivo' => 'bambino.png', 'nivel' => 1],
['nombre' => 'Beeboo', 'tipo' => 'Aire', 'tamano' => 'pequeño', 'archivo' => 'beeboo.png', 'nivel' => 1],
['nombre' => 'Boo-hoot', 'tipo' => 'Aire', 'tamano' => 'pequeño', 'archivo' => 'boo-hoot.png', 'nivel' => 1],
['nombre' => 'Cabrales', 'tipo' => 'Tierra', 'tamano' => 'grande', 'archivo' => 'cabrales.png', 'nivel' => 3],
['nombre' => 'Catua', 'tipo' => 'Aire', 'tamano' => 'pequeño', 'archivo' => 'catua.png', 'nivel' => 1],
['nombre' => 'Catyuska', 'tipo' => 'Aire', 'tamano' => 'grande', 'archivo' => 'catyuska.png', 'nivel' => 3],
['nombre' => 'Chapapá', 'tipo' => 'Agua', 'tamano' => 'grande', 'archivo' => 'chapapa.png', 'nivel' => 3],
['nombre' => 'Chopper', 'tipo' => 'Tierra', 'tamano' => 'grande', 'archivo' => 'chopper.png', 'nivel' => 3],

        ];

        foreach ($xuxemons as $xuxemon) {
            xuxemons::create($xuxemon);
        }
    }
}
