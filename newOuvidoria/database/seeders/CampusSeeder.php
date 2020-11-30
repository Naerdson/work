<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('campus')->insert([
            ['nome' => 'Campus Conselheiro Estelita'],
            ['nome' => 'Campus Padre Ibiapina'],
            ['nome' => 'Campus Guilherme Rocha'],
            ['nome' => 'Campus Carneiro da Cunha'],
            ['nome' => 'Campus Maracanaú'],
            ['nome' => 'Campus Cascavel'],
            ['nome' => 'Campus Aldeota'],
            ['nome' => 'Campus Messejana'],
            ['nome' => 'Clínica Escola'],
            ['nome' => 'Complexo Odontológico'],
            ['nome' => 'NPJ (Núcleo de Práticas Jurídicas)'],
        ]);
    }
}
