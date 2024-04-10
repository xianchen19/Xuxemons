<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\xuxemons;

class xuxemonSeeder extends Seeder
{
    public function run()
    {
        $xuxemons = [
           ['nombre' => 'Apleki', 'tipo' => 'Tierra', 'tamano' => 'mediano', 'archivo' => 'apleki.png'],
['nombre' => 'Avecrem', 'tipo' => 'Aire', 'tamano' => 'grande', 'archivo' => 'avecrem.png'],
['nombre' => 'Bambino', 'tipo' => 'Tierra', 'tamano' => 'grande', 'archivo' => 'bambino.png'],
['nombre' => 'Beeboo', 'tipo' => 'Aire', 'tamano' => 'pequeño', 'archivo' => 'beeboo.png'],
['nombre' => 'Boo-hoot', 'tipo' => 'Aire', 'tamano' => 'mediano', 'archivo' => 'boo-hoot.png'],
['nombre' => 'Cabrales', 'tipo' => 'Tierra', 'tamano' => 'grande', 'archivo' => 'cabrales.png'],
['nombre' => 'Catua', 'tipo' => 'Aire', 'tamano' => 'pequeño', 'archivo' => 'catua.png'],
['nombre' => 'Catyuska', 'tipo' => 'Aire', 'tamano' => 'grande', 'archivo' => 'catyuska.png'],
['nombre' => 'Chapapá', 'tipo' => 'Agua', 'tamano' => 'grande', 'archivo' => 'chapapa.png'],
['nombre' => 'Chopper', 'tipo' => 'Tierra', 'tamano' => 'grande', 'archivo' => 'chopper.png'],
['nombre' => 'Cuellilargui', 'tipo' => 'Tierra', 'tamano' => 'grande', 'archivo' => 'cuellilargui.png'],
['nombre' => 'Deskangoo', 'tipo' => 'Tierra', 'tamano' => 'grande', 'archivo' => 'deskangoo.png'],
['nombre' => 'Doflamingo', 'tipo' => 'Aire', 'tamano' => 'grande', 'archivo' => 'doflamingo.png'],
['nombre' => 'Dolly', 'tipo' => 'Tierra', 'tamano' => 'grande', 'archivo' => 'dolly.png'],
['nombre' => 'Elconchudo', 'tipo' => 'Agua', 'tamano' => 'grande', 'archivo' => 'elconchudo.png'],
['nombre' => 'Eldientes', 'tipo' => 'Agua', 'tamano' => 'grande', 'archivo' => 'eldientes.png'],
['nombre' => 'Elgominas', 'tipo' => 'Tierra', 'tamano' => 'grande', 'archivo' => 'elgominas.png'],
['nombre' => 'Flipper', 'tipo' => 'Agua', 'tamano' => 'grande', 'archivo' => 'flipper.png'],
['nombre' => 'Floppi', 'tipo' => 'Tierra', 'tamano' => 'grande', 'archivo' => 'floppi.png'],
['nombre' => 'Horseluis', 'tipo' => 'Agua', 'tamano' => 'grande', 'archivo' => 'horseluis.png'],
['nombre' => 'Krokolisko', 'tipo' => 'Agua', 'tamano' => 'grande', 'archivo' => 'krokolisko.png'],
['nombre' => 'Kurama', 'tipo' => 'Tierra', 'tamano' => 'grande', 'archivo' => 'kurama.png'],
['nombre' => 'Ladybug', 'tipo' => 'Aire', 'tamano' => 'grande', 'archivo' => 'ladybug.png'],
['nombre' => 'Lengualargui', 'tipo' => 'Tierra', 'tamano' => 'grande', 'archivo' => 'lengualargui.png'],
['nombre' => 'Medusation', 'tipo' => 'Agua', 'tamano' => 'grande', 'archivo' => 'medusation.png'],
['nombre' => 'Meekmeek', 'tipo' => 'Tierra', 'tamano' => 'grande', 'archivo' => 'meekmeek.png'],
['nombre' => 'Megalo', 'tipo' => 'Agua', 'tamano' => 'grande', 'archivo' => 'megalo.png'],
['nombre' => 'Mocha', 'tipo' => 'Agua', 'tamano' => 'grande', 'archivo' => 'mocha.png'],
['nombre' => 'Murcimurci', 'tipo' => 'Aire', 'tamano' => 'grande', 'archivo' => 'murcimurci.png'],
['nombre' => 'Nemo', 'tipo' => 'Agua', 'tamano' => 'grande', 'archivo' => 'nemo.png'],
['nombre' => 'Oinkcelot', 'tipo' => 'Tierra', 'tamano' => 'grande', 'archivo' => 'oinkcelot.png'],
['nombre' => 'Oreo', 'tipo' => 'Tierra', 'tamano' => 'grande', 'archivo' => 'oreo.png'],
['nombre' => 'Otto', 'tipo' => 'Tierra', 'tamano' => 'grande', 'archivo' => 'otto.png'],
['nombre' => 'Pinchimott', 'tipo' => 'Agua', 'tamano' => 'grande', 'archivo' => 'pinchimott.png'],
['nombre' => 'Pollis', 'tipo' => 'Aire', 'tamano' => 'grande', 'archivo' => 'pollis.png'],
['nombre' => 'Posón', 'tipo' => 'Aire', 'tamano' => 'grande', 'archivo' => 'poson.png'],
['nombre' => 'Quakko', 'tipo' => 'Agua', 'tamano' => 'grande', 'archivo' => 'quakko.png'],
['nombre' => 'Rajoy', 'tipo' => 'Aire', 'tamano' => 'grande', 'archivo' => 'rajoy.png'],
['nombre' => 'Rawlion', 'tipo' => 'Tierra', 'tamano' => 'grande', 'archivo' => 'rawlion.png'],
['nombre' => 'Rexxo', 'tipo' => 'Tierra', 'tamano' => 'grande', 'archivo' => 'rexxo.png'],
['nombre' => 'Ron', 'tipo' => 'Tierra', 'tamano' => 'grande', 'archivo' => 'ron.png'],
['nombre' => 'Sesssi', 'tipo' => 'Tierra', 'tamano' => 'grande', 'archivo' => 'sesssi.png'],
['nombre' => 'Shelly', 'tipo' => 'Agua', 'tamano' => 'grande', 'archivo' => 'shelly.png'],
['nombre' => 'Sirucco', 'tipo' => 'Aire', 'tamano' => 'grande', 'archivo' => 'sirucco.png'],
['nombre' => 'Torcas', 'tipo' => 'Agua', 'tamano' => 'grande', 'archivo' => 'torcas.png'],
['nombre' => 'Trompeta', 'tipo' => 'Aire', 'tamano' => 'grande', 'archivo' => 'trompeta.png'],
['nombre' => 'Trompi', 'tipo' => 'Tierra', 'tamano' => 'grande', 'archivo' => 'trompi.png'],
['nombre' => 'Tux', 'tipo' => 'Agua', 'tamano' => 'grande', 'archivo' => 'tux.png'],

        ];

        foreach ($xuxemons as $xuxemon) {
            xuxemons::create($xuxemon);
        }
    }
}
