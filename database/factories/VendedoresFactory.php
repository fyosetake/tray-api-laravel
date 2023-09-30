<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Vendedores;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vendedor>
 */
class VendedoresFactory extends Factory
{
    protected $model = Vendedores::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
