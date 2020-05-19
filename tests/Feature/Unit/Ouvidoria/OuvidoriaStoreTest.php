<?php

namespace Tests\Feature\Unit\Ouvidoria;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class OuvidoriaStoreTest extends TestCase
{

    public function testCriarOuvidoriaComSucesso()
    {
        $nome = 'Moises abreu rodrigues';
        $contato = 'moises.rodrigues@aluno.unifametro.edu.br';
        $descricao = 'Mussum Ipsum, cacilds vidis litro abertis. Sapien in monti palavris qui num significa nadis i pareci latim. Paisis, filhis, espiritis santis. Per aumento de cachacis, eu reclamis. Interagi no mé, cursus quis, vehicula ac nisi.';
        $categoria =  1;
        $demandante = 2;
        $campus = 5;

        $postData = [
            'nome' => $nome,
            'contato' => $contato,
            'descricao' => $descricao,
            'categoria_id' => $categoria,
            'demandante_id' => $demandante,
            'campus_id' => $campus,
        ];

        $response = $this->json('POST', 'api/ouvidoria', $postData);

        $response->assertStatus(201);

        $response->assertJson([
            'docs' => [
                'ouvidoria' => [
                    'nome' => $postData['nome'],
                    'contato' => $postData['contato'],
                    'descricao' => $postData['descricao'],
                    'categoria_id' => $postData['categoria_id'],
                    'demandante_id' => $postData['demandante_id'],
                    'campus_id' => $postData['campus_id']
                ]
            ]
        ]);
    }

    public function testErrorCamposObrigatorios()
    {

        $response = $this->json('POST', 'api/ouvidoria', []);
        $response->assertStatus(500);
    }
}
