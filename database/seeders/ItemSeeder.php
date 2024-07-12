<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'Espada de Zoro',
                'image' => '',
                'level' => 1,
                'min_vitality' => 1,
                'max_vitality' => 1,
                'min_defense' => 1,
                'max_defense' => 1,
                'min_experience' => 1,
                'max_experience' => 1,
                'min_luck' => 1,
                'max_luck' => 1,
                'min_attack' => 1,
                'max_attack' => 1,
                'min_armor_penetration' => 1,
                'max_armor_penetration' => 1,
                'min_critical' => 1,
                'max_critical' => 1,
            ]
        ];

        DB::table('items')->insert([
            ...$data,
        ]);
    }
}
