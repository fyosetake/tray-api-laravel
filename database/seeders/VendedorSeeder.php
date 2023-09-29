<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vendedor;

class VendedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Vendedor::factory()->count(10)->create();
    }
}
