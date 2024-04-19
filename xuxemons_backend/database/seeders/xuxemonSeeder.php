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
['nombre' => 'Cuellilargui', 'tipo' => 'Tierra', 'tamano' => 'grande', 'archivo' => 'cuellilargui.png', 'nivel' => 3],
['nombre' => 'Deskangoo', 'tipo' => 'Tierra', 'tamano' => 'grande', 'archivo' => 'deskangoo.png', 'nivel' => 3],
['nombre' => 'Doflamingo', 'tipo' => 'Aire', 'tamano' => 'grande', 'archivo' => 'doflamingo.png', 'nivel' => 3],
['nombre' => 'Dolly', 'tipo' => 'Tierra', 'tamano' => 'grande', 'archivo' => 'dolly.png', 'nivel' => 3],
['nombre' => 'Elconchudo', 'tipo' => 'Agua', 'tamano' => 'grande', 'archivo' => 'elconchudo.png', 'nivel' => 3],
['nombre' => 'Eldientes', 'tipo' => 'Agua', 'tamano' => 'grande', 'archivo' => 'eldientes.png', 'nivel' => 3],
['nombre' => 'Elgominas', 'tipo' => 'Tierra', 'tamano' => 'grande', 'archivo' => 'elgominas.png', 'nivel' => 3],
['nombre' => 'Flipper', 'tipo' => 'Agua', 'tamano' => 'grande', 'archivo' => 'flipper.png', 'nivel' => 3],
['nombre' => 'Floppi', 'tipo' => 'Tierra', 'tamano' => 'grande', 'archivo' => 'floppi.png', 'nivel' => 3],
['nombre' => 'Horseluis', 'tipo' => 'Agua', 'tamano' => 'grande', 'archivo' => 'horseluis.png', 'nivel' => 3],
['nombre' => 'Krokolisko', 'tipo' => 'Agua', 'tamano' => 'grande', 'archivo' => 'krokolisko.png', 'nivel' => 3],
['nombre' => 'Kurama', 'tipo' => 'Tierra', 'tamano' => 'grande', 'archivo' => 'kurama.png', 'nivel' => 3],
['nombre' => 'Ladybug', 'tipo' => 'Aire', 'tamano' => 'grande', 'archivo' => 'ladybug.png', 'nivel' => 3],
['nombre' => 'Lengualargui', 'tipo' => 'Tierra', 'tamano' => 'grande', 'archivo' => 'lengualargui.png', 'nivel' => 3],
['nombre' => 'Medusation', 'tipo' => 'Agua', 'tamano' => 'grande', 'archivo' => 'medusation.png', 'nivel' => 3],
['nombre' => 'Meekmeek', 'tipo' => 'Tierra', 'tamano' => 'grande', 'archivo' => 'meekmeek.png', 'nivel' => 3],
['nombre' => 'Megalo', 'tipo' => 'Agua', 'tamano' => 'grande', 'archivo' => 'megalo.png', 'nivel' => 3],
['nombre' => 'Mocha', 'tipo' => 'Agua', 'tamano' => 'grande', 'archivo' => 'mocha.png', 'nivel' => 3],
['nombre' => 'Murcimurci', 'tipo' => 'Aire', 'tamano' => 'grande', 'archivo' => 'murcimurci.png', 'nivel' => 3],
['nombre' => 'Nemo', 'tipo' => 'Agua', 'tamano' => 'grande', 'archivo' => 'nemo.png', 'nivel' => 3],
['nombre' => 'Oinkcelot', 'tipo' => 'Tierra', 'tamano' => 'grande', 'archivo' => 'oinkcelot.png', 'nivel' => 3],
['nombre' => 'Oreo', 'tipo' => 'Tierra', 'tamano' => 'grande', 'archivo' => 'oreo.png', 'nivel' => 3],
['nombre' => 'Otto', 'tipo' => 'Tierra', 'tamano' => 'grande', 'archivo' => 'otto.png', 'nivel' => 3],
['nombre' => 'Pinchimott', 'tipo' => 'Agua', 'tamano' => 'grande', 'archivo' => 'pinchimott.png', 'nivel' => 3],
['nombre' => 'Pollis', 'tipo' => 'Aire', 'tamano' => 'grande', 'archivo' => 'pollis.png', 'nivel' => 3],
['nombre' => 'Posón', 'tipo' => 'Aire', 'tamano' => 'grande', 'archivo' => 'poson.png', 'nivel' => 3],
['nombre' => 'Quakko', 'tipo' => 'Agua', 'tamano' => 'grande', 'archivo' => 'quakko.png', 'nivel' => 3],
['nombre' => 'Rajoy', 'tipo' => 'Aire', 'tamano' => 'grande', 'archivo' => 'rajoy.png', 'nivel' => 3],
['nombre' => 'Rawlion', 'tipo' => 'Tierra', 'tamano' => 'grande', 'archivo' => 'rawlion.png', 'nivel' => 3],
['nombre' => 'Rexxo', 'tipo' => 'Tierra', 'tamano' => 'grande', 'archivo' => 'rexxo.png', 'nivel' => 3],
['nombre' => 'Ron', 'tipo' => 'Tierra', 'tamano' => 'grande', 'archivo' => 'ron.png', 'nivel' => 3],
['nombre' => 'Sesssi', 'tipo' => 'Tierra', 'tamano' => 'grande', 'archivo' => 'sesssi.png', 'nivel' => 3],
['nombre' => 'Shelly', 'tipo' => 'Agua', 'tamano' => 'grande', 'archivo' => 'shelly.png', 'nivel' => 3],
['nombre' => 'Sirucco', 'tipo' => 'Aire', 'tamano' => 'grande', 'archivo' => 'sirucco.png', 'nivel' => 3],
['nombre' => 'Torcas', 'tipo' => 'Agua', 'tamano' => 'grande', 'archivo' => 'torcas.png', 'nivel' => 3],
['nombre' => 'Trompeta', 'tipo' => 'Aire', 'tamano' => 'grande', 'archivo' => 'trompeta.png', 'nivel' => 3],
['nombre' => 'Trompi', 'tipo' => 'Tierra', 'tamano' => 'grande', 'archivo' => 'trompi.png', 'nivel' => 3],
['nombre' => 'Tux', 'tipo' => 'Agua', 'tamano' => 'grande', 'archivo' => 'tux.png', 'nivel' => 3],

        ];

        foreach ($xuxemons as $xuxemon) {
            xuxemons::create($xuxemon);
        }
    }
}
