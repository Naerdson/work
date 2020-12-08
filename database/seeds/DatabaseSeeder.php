<?php

use App\NivelUsuario;
use App\Ouvidoria;
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
            CampusSeeder::class,
            NivelUsuarioSeeder::class,
            OuvidoriaCategoriaSeeder::class,
            OuvidoriaDemandanteSeeder::class,
            OuvidoriaStatusSeeder::class,
            SetorSeeder::class,
            TipoContatoSeeder::class,
            PerguntasPesquisaSatisfacaoSeeder::class
        ]);
    }
}
