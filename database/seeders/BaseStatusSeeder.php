<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BaseStatusSeeder extends Seeder
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
            ],
        ];

        DB::table('base_statuses')->insert([
            ...$data,
        ]);
    }
}
