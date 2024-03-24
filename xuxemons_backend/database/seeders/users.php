<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insertar un usuario normal
        User::create([
            'name' => 'Usuario normal',
            'email' => 'andy@andy',
            'password' => 'contraseña', // Recuerda cifrar la contraseña
            'role' => 'usuario',
            'monedas' => 100, // Por ejemplo, 100 monedas
        ]);

        // Insertar un usuario administrador
        User::create([
            'name' => 'Administrador',
            'email' => 'xian@xian',
            'password' => 'contraseña',
            'role' => 'administrador',
            'monedas' => 0, // Por ejemplo, 0 monedas
        ]);
    }
}
