<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tarefa>
 */
class TarefaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomNumber = $this->faker->numberBetween(1, 9999);
        return [
            'nome' => "Tarefa $randomNumber",
            'concluida' => $this->faker->boolean(),
            'user_id' => User::factory()
        ];
    }
}
