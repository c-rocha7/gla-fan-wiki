<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemDropSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'item_id' => 1,
                'drop_id' => 1,
            ],
        ];

        DB::table('item_drops')->insert([
            ...$data,
        ]);
    }
}
