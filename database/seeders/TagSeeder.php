<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'All'
            ],
            [
                'name' => 'Atirador'
            ],
            [
                'name' => 'Bruiser'
            ],
            [
                'name' => 'Chapéu De Palha'
            ],
            [
                'name' => 'Cortante'
            ],
            [
                'name' => 'DPS'
            ],
            [
                'name' => 'Especialista'
            ],
            [
                'name' => 'Fruta Do Diabo'
            ],
            [
                'name' => 'Lutador'
            ],
            [
                'name' => 'Marinheiro'
            ],
            [
                'name' => 'Realeza'
            ],
            [
                'name' => 'Shichibukai'
            ],
            [
                'name' => 'Suporte'
            ],
            [
                'name' => 'Supernova'
            ],
            [
                'name' => 'Tanque'
            ],
            [
                'name' => 'Tritão'
            ],
        ];

        DB::table('tags')->insert([
            ...$data,
        ]);
    }
}
