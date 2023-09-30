<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vendedores;

class VendedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Vendedores::factory()->count(10)->create();
    }
}
