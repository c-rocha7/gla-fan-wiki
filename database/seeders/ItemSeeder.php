<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name'                  => 'Bandana de Bandido',
                'image'                 => '',
                'level'                 => 1,
                'min_vitality'          => 2,
                'max_vitality'          => 3,
                'min_defense'           => 1,
                'max_defense'           => 24,
                'min_experience'        => 30,
                'max_experience'        => 0,
                'min_luck'              => 0,
                'max_luck'              => 0,
                'min_attack'            => 0,
                'max_attack'            => 0,
                'min_armor_penetration' => 0,
                'max_armor_penetration' => 0,
                'min_critical'          => 0,
                'max_critical'          => 0,
            ]
        ];

        DB::table('items')->insert([
            ...$data,
        ]);
    }
}
