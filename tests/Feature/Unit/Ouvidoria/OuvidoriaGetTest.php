<?php

namespace Tests\Feature\Unit\Ouvidoria;

use App\Models\helpers;
use App\Models\Ouvidoria;
use Tests\TestCase;

class OuvidoriaGetTest extends TestCase
{

    public function testRecuperaOuvidoriaPeloNumeroDeProtocoloCorreto()
    {
        $form = $this->form();

        $OuvidoriaInstance = Ouvidoria::create($form->data);

        $response = $this->get("api/historico?protocolo={$OuvidoriaInstance->protocolo}");
        $response->assertStatus(200);

    }

    public function testRecuperaOuvidoriaPeloNumeroDeProtocoloIncorreto()
    {
        $response = $this->get("api/historico?protocolo=1805201816AQ");
        $response->assertStatus(422);
    }

    private function form()
    {
        $protocol = new helpers();

        return (object) [
            'data' => [
                'protocolo' => $protocol->generateProtocol(2),
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
