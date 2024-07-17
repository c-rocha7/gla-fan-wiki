<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemTypeSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'item_id' => 1,
                'type_id' => 1,
            ],
        ];

        DB::table('item_types')->insert([
            ...$data,
        ]);
    }
}
