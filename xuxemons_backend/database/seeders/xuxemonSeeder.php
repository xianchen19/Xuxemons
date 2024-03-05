<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\xuxemons;

class xuxemonSeeder extends Seeder
{
    public function run()
    {
        $xuxemons = [
            ['nombre' => 'Apleki', 'tipo' => 'Tierra', 'tamaño' => 50, 'archivo' => 'apleki.png'],
            ['nombre' => 'Avecrem', 'tipo' => 'Aire', 'tamaño' => 60, 'archivo' => 'avecrem.png'],
            ['nombre' => 'Bambino', 'tipo' => 'Tierra', 'tamaño' => 70, 'archivo' => 'bambino.png'],
            ['nombre' => 'Beeboo', 'tipo' => 'Aire', 'tamaño' => 45, 'archivo' => 'beeboo.png'],
            ['nombre' => 'Boo-hoot', 'tipo' => 'Aire', 'tamaño' => 55, 'archivo' => 'boo-hoot.png'],
            ['nombre' => 'Cabrales', 'tipo' => 'Tierra', 'tamaño' => 65, 'archivo' => 'cabrales.png'],
            ['nombre' => 'Catua', 'tipo' => 'Aire', 'tamaño' => 40, 'archivo' => 'catua.png'],
            ['nombre' => 'Catyuska', 'tipo' => 'Aire', 'tamaño' => 75, 'archivo' => 'catyuska.png'],
            ['nombre' => 'Chapapá', 'tipo' => 'Agua', 'tamaño' => 80, 'archivo' => 'chapapa.png'],
            ['nombre' => 'Chopper', 'tipo' => 'Tierra', 'tamaño' => 90, 'archivo' => 'chopper.png'],
            ['nombre' => 'Cuellilargui', 'tipo' => 'Tierra', 'tamaño' => 85, 'archivo' => 'cuellilargui.png'],
            ['nombre' => 'Deskangoo', 'tipo' => 'Tierra', 'tamaño' => 95, 'archivo' => 'deskangoo.png'],
            ['nombre' => 'Doflamingo', 'tipo' => 'Aire', 'tamaño' => 100, 'archivo' => 'doflamingo.png'],
            ['nombre' => 'Dolly', 'tipo' => 'Tierra', 'tamaño' => 110, 'archivo' => 'dolly.png'],
            ['nombre' => 'Elconchudo', 'tipo' => 'Agua', 'tamaño' => 120, 'archivo' => 'elconchudo.png'],
            ['nombre' => 'Eldientes', 'tipo' => 'Agua', 'tamaño' => 125, 'archivo' => 'eldientes.png'],
            ['nombre' => 'Elgominas', 'tipo' => 'Tierra', 'tamaño' => 130, 'archivo' => 'elgominas.png'],
            ['nombre' => 'Flipper', 'tipo' => 'Agua', 'tamaño' => 135, 'archivo' => 'flipper.png'],
            ['nombre' => 'Floppi', 'tipo' => 'Tierra', 'tamaño' => 140, 'archivo' => 'floppi.png'],
            ['nombre' => 'Horseluis', 'tipo' => 'Agua', 'tamaño' => 145, 'archivo' => 'horseluis.png'],
            ['nombre' => 'Krokolisko', 'tipo' => 'Agua', 'tamaño' => 150, 'archivo' => 'krokolisko.png'],
            ['nombre' => 'Kurama', 'tipo' => 'Tierra', 'tamaño' => 155, 'archivo' => 'kurama.png'],
            ['nombre' => 'Ladybug', 'tipo' => 'Aire', 'tamaño' => 160, 'archivo' => 'ladybug.png'],
            ['nombre' => 'Lengualargui', 'tipo' => 'Tierra', 'tamaño' => 165, 'archivo' => 'lengualargui.png'],
            ['nombre' => 'Medusation', 'tipo' => 'Agua', 'tamaño' => 170, 'archivo' => 'medusation.png'],
            ['nombre' => 'Meekmeek', 'tipo' => 'Tierra', 'tamaño' => 175, 'archivo' => 'meekmeek.png'],
            ['nombre' => 'Megalo', 'tipo' => 'Agua', 'tamaño' => 180, 'archivo' => 'megalo.png'],
            ['nombre' => 'Mocha', 'tipo' => 'Agua', 'tamaño' => 185, 'archivo' => 'mocha.png'],
            ['nombre' => 'Murcimurci', 'tipo' => 'Aire', 'tamaño' => 190, 'archivo' => 'murcimurci.png'],
            ['nombre' => 'Nemo', 'tipo' => 'Agua', 'tamaño' => 195, 'archivo' => 'nemo.png'],
            ['nombre' => 'Oinkcelot', 'tipo' => 'Tierra', 'tamaño' => 200, 'archivo' => 'oinkcelot.png'],
            ['nombre' => 'Oreo', 'tipo' => 'Tierra', 'tamaño' => 205, 'archivo' => 'oreo.png'],
            ['nombre' => 'Otto', 'tipo' => 'Tierra', 'tamaño' => 210, 'archivo' => 'otto.png'],
            ['nombre' => 'Pinchimott', 'tipo' => 'Agua', 'tamaño' => 215, 'archivo' => 'pinchimott.png'],
            ['nombre' => 'Pollis', 'tipo' => 'Aire', 'tamaño' => 220, 'archivo' => 'pollis.png'],
            ['nombre' => 'Posón', 'tipo' => 'Aire', 'tamaño' => 225, 'archivo' => 'poson.png'],
            ['nombre' => 'Quakko', 'tipo' => 'Agua', 'tamaño' => 230, 'archivo' => 'quakko.png'],
            ['nombre' => 'Rajoy', 'tipo' => 'Aire', 'tamaño' => 235, 'archivo' => 'rajoy.png'],
            ['nombre' => 'Rawlion', 'tipo' => 'Tierra', 'tamaño' => 240, 'archivo' => 'rawlion.png'],
            ['nombre' => 'Rexxo', 'tipo' => 'Tierra', 'tamaño' => 245, 'archivo' => 'rexxo.png'],
            ['nombre' => 'Ron', 'tipo' => 'Tierra', 'tamaño' => 250, 'archivo' => 'ron.png'],
            ['nombre' => 'Sesssi', 'tipo' => 'Tierra', 'tamaño' => 255, 'archivo' => 'sesssi.png'],
            ['nombre' => 'Shelly', 'tipo' => 'Agua', 'tamaño' => 260, 'archivo' => 'shelly.png'],
            ['nombre' => 'Sirucco', 'tipo' => 'Aire', 'tamaño' => 265, 'archivo' => 'sirucco.png'],
            ['nombre' => 'Torcas', 'tipo' => 'Agua', 'tamaño' => 270, 'archivo' => 'torcas.png'],
            ['nombre' => 'Trompeta', 'tipo' => 'Aire', 'tamaño' => 275, 'archivo' => 'trompeta.png'],
            ['nombre' => 'Trompi', 'tipo' => 'Tierra', 'tamaño' => 280, 'archivo' => 'trompi.png'],
            ['nombre' => 'Tux', 'tipo' => 'Agua', 'tamaño' => 285, 'archivo' => 'tux.png'],
        ];

        foreach ($xuxemons as $xuxemon) {
            xuxemons::create($xuxemon);
        }
    }
}
