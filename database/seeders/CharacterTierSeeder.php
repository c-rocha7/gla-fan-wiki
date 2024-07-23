<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CharacterTierSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'character_id' => 1,
                'tier_id'      => 4,
            ],
        ];

        DB::table('character_tiers')->insert([
            ...$data,
        ]);
    }
}
