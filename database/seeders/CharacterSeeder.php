<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CharacterSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'icon'        => '',
                'image'       => '',
                'name'        => 'Aokiji',
                'slug'        => 'aokiji',
                'description' => '',
            ],
        ];

        DB::table('characters')->insert([
            ...$data,
        ]);
    }
}
