<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_aplicacao_registra_um_novo_usuario()
    {
        $userForm = [
            'name' => 'test',
            'email' => 'test@example.com',
            'password' => 'Test@123'
        ];

        $jsonResponse = [
            'data' => [
                'id' => 1,
                'name' => 'test',
                'email' => 'test@example.com'
            ]
        ];

        $response = $this->postJson('/api/v1/register', $userForm);

        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJson($jsonResponse);

        $this->assertDatabaseHas('users', [ 'email' => 'test@example.com']);

    }

    public function test_a_aplicacao_retorna_erro_ao_receber_usuario_invalido()
    {
        $userForm = [
            'name' => 'test',
            'email' => 'invalid#email.com',
            'password' => 'Test@123'
        ];

        $jsonResponse = [
            'message' => 'O campo email deve ser um endereço de e-mail válido.',
            'errors' => [
                'email' => ['O campo email deve ser um endereço de e-mail válido.'],
            ]
        ];

        $response = $this->postJson('/api/v1/register', $userForm);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson($jsonResponse);

        $this->assertDatabaseMissing('users', [ 'email' => 'test@example.com']);
    }

    public function test_a_aplicacao_realiza_login_com_sucesso()
    {

        $userForm = [
            'name' => 'test',
            'email' => 'test@example.com',
            'password' => 'Test@123'
        ];

        User::factory()->create($userForm);

        $response = $this->postJson('/api/v1/login', $userForm);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson(function ($json){
            $json->has('token');
        });

    }

    public function test_a_aplicacao_realiza_logout_com_sucesso()
    {

        $user = User::factory()->create();
        $this->actingAs($user);
        $token = $user->createToken('token');

        $logoutResponse = $this->withHeaders(['Authorization' => "Bearer $token->plainTextToken"])->post('/api/v1/logout');
        $logoutResponse->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseMissing('personal_access_tokens', [ 'id' => $token->accessToken->id]);

    }
}
