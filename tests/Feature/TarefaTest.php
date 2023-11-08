<?php


use App\Models\Tarefa;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class TarefaTest extends TestCase
{
//    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_aplicacao_permite_ver_tarefa_criada()
    {

        $userComTarefa = User::factory()->has(Tarefa::factory())->createQuietly();
        $tarefa = $userComTarefa->tarefas()->first();

        $this->actingAs($userComTarefa);

        $response = $this->get("/api/v1/tarefas/$tarefa->id");
        $response->assertJsonStructure([
            'data' => [
                'id',
                'nome',
                'concluida'
            ]
        ]);

        $response->assertStatus(Response::HTTP_OK);

    }

    public function test_a_aplicacao_nao_permite_ver_tarefa_de_outro_usuario()
    {

        $userSemTarefa = User::factory()->create();
        $tarefa = Tarefa::factory()->createQuietly();

        $this->actingAs($userSemTarefa);

        $response = $this->get("/api/v1/tarefas/$tarefa->id");

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);

    }

    public function test_a_aplicacao_cria_nova_tarefa_com_sucesso()
    {

        $user = User::factory()->create();
        $tarefa = Tarefa::factory()->createQuietly();

        $this->actingAs($user);

        $response = $this->postJson("/api/v1/tarefas", $tarefa->toArray());

        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'nome',
                'concluida'
            ]
        ]);
        $this->assertDatabaseHas('tarefas', [ 'id' => $response->json()['data']['id']]);

    }

    public function test_a_aplicacao_valida_a_criacao_de_tarefa()
    {

        $user = User::factory()->create();
        $tarefa = Tarefa::factory()->createQuietly();
        $tarefa->setAttribute('concluida','valorInvalido');
        $this->actingAs($user);

        $response = $this->postJson("/api/v1/tarefas", $tarefa->toArray());
        $response->assertJsonStructure([
            'message',
            'errors' => [
                'concluida'
            ]
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

    }

    public function test_a_aplicacao_permite_atualizar_tarefa()
    {

        $userComTarefa = User::factory()->has(Tarefa::factory())->createQuietly();
        $tarefa = $userComTarefa->tarefas()->first();

        $this->actingAs($userComTarefa);

        $response = $this->putJson("/api/v1/tarefas/$tarefa->id", ['concluida' => 1]);


        $response->assertStatus(Response::HTTP_OK);

    }

    public function test_a_aplicacao_valida_a_atualizacao_de_tarefa()
    {

        $userComTarefa = User::factory()->has(Tarefa::factory())->createQuietly();
        $tarefa = $userComTarefa->tarefas()->first();
        $tarefa->setAttribute('concluida','valorInvalido');

        $this->actingAs($userComTarefa);

        $response = $this->putJson("/api/v1/tarefas/$tarefa->id", $tarefa->toArray());

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'concluida'
            ]
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

    }

    public function test_a_aplicacao_nao_permite_atualizar_tarefa_de_outro_usuario()
    {

        $userSemTarefa = User::factory()->create();
        $tarefa = Tarefa::factory()->createQuietly();

        $this->actingAs($userSemTarefa);

        $response = $this->putJson("/api/v1/tarefas/$tarefa->id", ['concluida' => 1]);
        $response->assertJson(['error' => 'Usuário não autorizado']);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);

    }

    public function test_a_aplicacao_permite_deletar_tarefa()
    {

        $userComTarefa = User::factory()->has(Tarefa::factory())->createQuietly();
        $tarefa = $userComTarefa->tarefas()->first();

        $this->actingAs($userComTarefa);

        $response = $this->delete("/api/v1/tarefas/$tarefa->id");

        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseMissing('tarefas', [ 'id' => $tarefa->id]);

    }

    public function test_a_aplicacao_nao_permite_deletar_tarefa_de_outro_usuario()
    {

        $user= User::factory()->create();
        $tarefa = Tarefa::factory()->createQuietly();

        $this->actingAs($user);

        $response = $this->delete("/api/v1/tarefas/$tarefa->id");

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
        $this->assertDatabaseHas( 'tarefas', [ 'id' => $tarefa->id]);

    }

}
