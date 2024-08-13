<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemTypeSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'Cabeça',
            ],
            [
                'name' => 'Corpo',
            ],
            [
                'name' => 'Pernas',
            ],
            [
                'name' => 'Arma',
            ],
            [
                'name' => 'Emblema',
            ],
            [
                'name' => 'Acessório',
            ],
            [
                'name' => 'Casco',
            ],
            [
                'name' => 'Vela',
            ],
            [
                'name' => 'Kit de Navio',
            ],
            [
                'name' => 'Skins',
            ],
            [
                'name' => 'Kit de Reparos',
            ],
            [
                'name' => 'Especiais',
            ],
            [
                'name' => 'Comidas',
            ],
            [
                'name' => 'Curativos',
            ],
        ];

        DB::table('item_types')->insert([
            ...$data
        ]);
    }
}
