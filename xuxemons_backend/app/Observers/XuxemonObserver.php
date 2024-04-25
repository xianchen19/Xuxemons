<?php
namespace App\Observers;

use App\Models\xuxemons;
use App\Models\User;

class XuxemonObserver
{
    public function updated(Xuxemons $xuxemon)
    {
        // Obtener todos los usuarios que tienen este Xuxemon
        $users = $xuxemon->users;

        // Iterar sobre cada usuario
        foreach ($users as $user) {
            // Obtener el registro de la tabla intermedia user_xuxemons para este usuario y este Xuxemon
            $pivot = $user->xuxemons()->where('xuxemons_id', $xuxemon->id)->first()->pivot;

            // Actualizar el campo tamano en el registro pivot
            $pivot->tamano = $xuxemon->tamano;
            $pivot->save();
        }
        if ($xuxemon->bajon_azucar) {
            $xuxemon->requisitos_crecimiento = 2; // Actualizar los requisitos de crecimiento
            $xuxemon->save();
        }
        
    }

    public function created(Xuxemons $xuxemon)
    {
        // Obtener todos los usuarios que tienen este Xuxemon
        $users = $xuxemon->users;

        // Iterar sobre cada usuario
        foreach ($users as $user) {
            // Sincronizar el campo tamano en el registro pivot
            $user->xuxemons()->updateExistingPivot($xuxemon->id, ['tamano' => $xuxemon->tamano]);
        }
    }
}
