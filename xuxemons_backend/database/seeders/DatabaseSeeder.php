<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(users::class);
        $this->call(xuxemonSeeder::class);
        $this->call(evo_config::class);
        $this->call(inventarioSeeder::class);
        $this->call(coleccion::class);
<<<<<<< HEAD
        $this->call(enfermedades::class);
=======
>>>>>>> 36c47a0f9bea999d24e080a78e1e1e0bb8a2cbfb
        
       


    }
}
