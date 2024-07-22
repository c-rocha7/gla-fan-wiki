<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TierSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'Bronze',
            ],
            [
                'name' => 'Prata',
            ],
            [
                'name' => 'Ouro',
            ],
            [
                'name' => 'Diamante',
            ],
        ];

        DB::table('tiers')->insert([
            ...$data,
        ]);
    }
}
