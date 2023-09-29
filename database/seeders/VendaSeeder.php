<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Venda;

class VendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Venda::factory()->count(10)->create();
    }
}
