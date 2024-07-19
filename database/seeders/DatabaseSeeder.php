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
            // CharacterSeeder::class,
            // TagSeeder::class,
            // BaseStatuSeeder::class,
            // ItemSeeder::class,
            // TypeSeeder::class,
            // DropSeeder::class,
            // CharacterTagSeeder::class,
            // CharacterBaseStatuSeeder::class,
            // SkillSeeder::class,
            // ItemTagSeeder::class,
            // ItemTypeSeeder::class,
            // ItemDropSeeder::class,
        ]);
    }
}
