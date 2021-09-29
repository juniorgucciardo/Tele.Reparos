<?php

namespace Database\Factories;

use App\Models\service_order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OSFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = service_order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome_cliente' => $this->faker->name,
            'rua_cliente' => $this->faker->name,
            'bairro_cliente' => $this->faker->name,
            'numero_liente' => $this->faker->numberBetween(200, 500),
            'descricao_servico' => $this->faker->sentence(15),
            'contato_cliente' => $this->faker->numberBetween(99999999, 88888888),
            'cidade_cliente' => $this->faker->name,
            'data_ordem' => $this->faker->data(),
            'hora_ordem' => $this->faker->time(),
            'id_service' => $this->faker->numberBetween(1, 5)
        ];
    }
}
