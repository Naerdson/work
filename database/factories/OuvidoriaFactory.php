<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\OuvidoriasOcorrencia;
use Faker\Generator as Faker;

$factory->define(OuvidoriasOcorrencia::class, function (Faker $faker) {
    return [
        'protocolo' => '200820150259OF',
        'nome' => $faker->name,
        'contato' => $faker->email,
        'tipo_contato_id' => 1,
        'descricao' => $faker->text(200),
        'categoria_id' => $faker->numberBetween(1, 5),
        'demandante_id' => $faker->numberBetween(1, 4),
        'campus_id' => $faker->numberBetween(1, 11)
    ];
});
