<?php

use Illuminate\Database\Seeder;
use App\Models\CategoriaGolfista;

class CategoriaGolfistaTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        CategoriaGolfista::truncate();
        CategoriaGolfista::create([

        ]);
    }
}
