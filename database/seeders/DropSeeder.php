<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DropSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'Normal'
            ],
            [
                'name' => 'Especial'
            ],
            [
                'name' => 'Evento'
            ],
            [
                'name' => 'Sem Drop'
            ]
        ];

        DB::table('drops')->insert([
            ...$data
        ]);
    }
}
