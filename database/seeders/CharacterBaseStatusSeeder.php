<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CharacterBaseStatusSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'character_id'   => 1,
                'base_status_id' => 1,
                'value'          => 4,
            ],
            [
                'character_id'   => 1,
                'base_status_id' => 2,
                'value'          => 3,
            ],
            [
                'character_id'   => 1,
                'base_status_id' => 3,
                'value'          => 3,
            ],
            [
                'character_id'   => 1,
                'base_status_id' => 4,
                'value'          => 2,
            ],
        ];

        DB::table('character_base_statuses')->insert([
            ...$data,
        ]);
    }
}
