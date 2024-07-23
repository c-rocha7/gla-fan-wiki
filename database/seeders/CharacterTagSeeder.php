<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CharacterTagSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'character_id' => 1,
                'tag_id'       => 5,
            ],
            [
                'character_id' => 1,
                'tag_id'       => 7,
            ],
            [
                'character_id' => 1,
                'tag_id'       => 8,
            ],
            [
                'character_id' => 1,
                'tag_id'       => 10,
            ],
            [
                'character_id' => 1,
                'tag_id'       => 15,
            ],
        ];

        DB::table('character_tags')->insert([
            ...$data,
        ]);
    }
}
