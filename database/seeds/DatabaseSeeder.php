<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            Campus::class,
            NivelUsuario::class,
            OuvidoriaCategorias::class,
            OuvidoriaDemandante::class,
            OuvidoriaStatus::class,
            Setor::class
        ]);
    }
}
