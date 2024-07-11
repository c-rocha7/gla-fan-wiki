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
                'icon'  => '',
                'photo' => '',
                'name'  => 'Aokiji',
                'slug'  => 'aokiji',
                'tier'  => 4,
            ],
            [
                'icon'  => '',
                'photo' => '',
                'name'  => 'Bartolomew Kuma',
                'slug'  => 'bartolomew-kuma',
                'tier'  => 4,
            ],
            [
                'icon'  => '',
                'photo' => '',
                'name'  => 'Boa Hancock',
                'slug'  => 'boa-hancock',
                'tier'  => 4,
            ],
            [
                'icon'  => '',
                'photo' => '',
                'name'  => 'Borsalino Kizaru',
                'slug'  => 'borsalino-kizaru',
                'tier'  => 4,
            ],
            [
                'icon'  => '',
                'photo' => '',
                'name'  => 'Baby 5',
                'slug'  => 'baby-5',
                'tier'  => 3,
            ],
            [
                'icon'  => '',
                'photo' => '',
                'name'  => 'Bartolomeo',
                'slug'  => 'bartolomeo',
                'tier'  => 3,
            ],
            [
                'icon'  => '',
                'photo' => '',
                'name'  => 'Basil Hawkins',
                'slug'  => 'basil-hawkins',
                'tier'  => 3,
            ],
            [
                'icon'  => '',
                'photo' => '',
                'name'  => 'Bastille',
                'slug'  => 'bastille',
                'tier'  => 3,
            ],
            [
                'icon'  => '',
                'photo' => '',
                'name'  => 'Satori',
                'slug'  => 'satori',
                'tier'  => 2,
            ],
            [
                'icon'  => '',
                'photo' => '',
                'name'  => 'Gedatsu',
                'slug'  => 'gedatsu',
                'tier'  => 2,
            ],
            [
                'icon'  => '',
                'photo' => '',
                'name'  => 'Ohm',
                'slug'  => 'ohm',
                'tier'  => 2,
            ],
            [
                'icon'  => '',
                'photo' => '',
                'name'  => 'Shura',
                'slug'  => 'shura',
                'tier'  => 2,
            ],
            [
                'icon'  => '',
                'photo' => '',
                'name'  => 'Alvida',
                'slug'  => 'alvida',
                'tier'  => 1,
            ],
            [
                'icon'  => '',
                'photo' => '',
                'name'  => 'Buchi & Sham',
                'slug'  => 'buchi-sham',
                'tier'  => 1,
            ],
            [
                'icon'  => '',
                'photo' => '',
                'name'  => 'Cabaji',
                'slug'  => 'cabaji',
                'tier'  => 1,
            ],
            [
                'icon'  => '',
                'photo' => '',
                'name'  => 'Chew',
                'slug'  => 'chew',
                'tier'  => 1,
            ],
        ];

        DB::table('characters')->insert([
            ...$data,
        ]);
    }
}
