<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BaseStatuSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'Ataque',
            ],
            [
                'name' => 'Defesa',
            ],
            [
                'name' => 'Vida',
            ],
            [
                'name' => 'Velocidade',
            ]
        ];

        DB::table('base_status')->insert([
            ...$data,
        ]);
    }
}
