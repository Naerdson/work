<?php

use App\Models\OuvidoriasOcorrencia;
use Illuminate\Database\Seeder;

class OuvidoriaOcorrenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(OuvidoriasOcorrencia::class, 20)->create();
    }
}
