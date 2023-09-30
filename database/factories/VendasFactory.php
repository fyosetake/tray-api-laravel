<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Vendas;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venda>
 */
class VendasFactory extends Factory
{
    protected $model = Vendas::class;

    public function definition()
    {
        $valor = $this->faker->randomFloat(2, 100, 1000);
        $comissao = $valor * 0.085;

        return [
            'vendedor_id' => function () {
                return \App\Models\Vendedores::factory()->create()->id;
            },
            'valor' => $valor,
            'comissao' => $comissao,
            'data' => $this->faker->date,
        ];
    }
}
