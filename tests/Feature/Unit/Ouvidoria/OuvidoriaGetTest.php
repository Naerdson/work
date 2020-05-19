<?php

namespace Tests\Feature\Unit\Ouvidoria;

use App\Ouvidoria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OuvidoriaGetTest extends TestCase
{

    public function testRecuperaOuvidoriaPeloNumeroDeProtocolo()
    {
        $form = $this->form();

        $OuvidoriaInstance = Ouvidoria::create($form->data);

        $response = $this->get("api/historico?protocolo={$OuvidoriaInstance->protocolo}");
        $response->assertStatus(200);

    }

    private function form()
    {
        return (object) [
            'data' => [
                'protocolo' => '1805201816AF',
                'nome' => 'Moises abreu rodrigues',
                'contato' => 'moises.rodrigues@aluno.unifametro.edu.br',
                'descricao' => 'Mussum Ipsum, cacilds vidis litro abertis. Sapien in monti palavris qui num significa nadis i pareci latim. Paisis, filhis, espiritis santis. Per aumento de cachacis, eu reclamis. Interagi no mé, cursus quis, vehicula ac nisi.',
                'categoria_id' => 1,
                'demandante_id' => 2,
                'campus_id' => 5,
                'status_id' => 1
            ]
        ];
    }
}
