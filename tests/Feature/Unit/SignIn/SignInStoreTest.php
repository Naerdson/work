<?php

namespace Tests\Feature\Unit\SignIn;


use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class SignInStoreTest extends TestCase
{
    use WithoutMiddleware;

    public function testSignInWithCredentialsCorrectly()
    {
        $credentials = [
            'usuario' => 'moises.rodrigues',
            'password' => 'caralho123@#',
        ];

        $this->post('/', $credentials)
            ->assertStatus(302);

        $this->assertDatabaseHas('usuario', ['usuario' => $credentials['usuario']]);
    }

    public function testSignInWithoutCredentialsCorrectly()
    {
        $credentials = [
            'usuario' => 'moises.rodrigues',
            'password' => 'vpn@2019i#',
        ];

        $response = $this->post('/', $credentials);

        $this->assertEquals(303, $response->getStatusCode());

    }
}
