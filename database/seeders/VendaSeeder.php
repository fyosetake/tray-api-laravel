<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vendas;

class VendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vendas::factory()->count(10)->create();
    }
}
