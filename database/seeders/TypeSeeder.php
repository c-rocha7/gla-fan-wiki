<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'Cabeça'
            ],
            [
                'name' => 'Corpo'
            ],
            [
                'name' => 'Pernas'
            ],
            [
                'name' => 'Emblema'
            ],
            [
                'name' => 'Arma'
            ],
            [
                'name' => 'Acessório'
            ]
        ];

        DB::table('types')->insert([
            ...$data,
        ]);
    }
}
