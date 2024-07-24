<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CharacterSeeder::class,
            TierSeeder::class,
            CharacterTierSeeder::class,
            TagSeeder::class,
            CharacterTagSeeder::class,
            BaseStatusSeeder::class,
            CharacterBaseStatusSeeder::class,
        ]);
    }
}
