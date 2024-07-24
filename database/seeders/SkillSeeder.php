<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'character_id' => 1,
                'icon'         => '',
                'name'         => 'Kick',
                'level'        => 1,
                'description'  => 'Kuzan é tão preguiçoso que prefere não tirar as mãos dos bolsos e opta por chutar p inimigo em vez de socá-lo.',
                'video'        => '',
                'recharge'     => 2,
                'energy'       => null,
                'pve_power'    => 15,
                'pvp_power'    => 9,
            ],
            [
                'character_id' => 1,
                'icon'         => '',
                'name'         => 'Ice Saber',
                'level'        => 5,
                'description'  => 'Kuzan materializa uma espada de gelo e desfere um golpe para frente, causando dano aos inimigos à sua frente.',
                'video'        => '',
                'recharge'     => 10,
                'energy'       => null,
                'pve_power'    => 26,
                'pvp_power'    => 18,
            ],
            [
                'character_id' => 1,
                'icon'         => '',
                'name'         => 'Ice Block: Partisan',
                'level'        => 12,
                'description'  => 'Kuzan utiliza o poder de sua Hie Hie no Mi para materializar lanças de geloacima dele e, em seguida, as lança para frente, causando dano duas vezes.',
                'video'        => '',
                'recharge'     => 18,
                'energy'       => -10,
                'pve_power'    => 14,
                'pvp_power'    => 12.5,
            ],
            [
                'character_id' => 1,
                'icon'         => '',
                'name'         => 'Ice Ball',
                'level'        => 20,
                'description'  => 'Kuzan condensa uma pequena esfera feita de ar frio e depois a faz explodir, liberando uma rajada de ar frio que faz seus inimigos tremerem. Essa habilidade causando dano e também reduz o ataque dos inimigos atingidos em 25%, ao mesmo tempo em que diminui a velocidade de movimento deles em 40 por 6 segundos.',
                'video'        => '',
                'recharge'     => 30,
                'energy'       => -20,
                'pve_power'    => 20,
                'pvp_power'    => 10,
            ],
            [
                'character_id' => 1,
                'icon'         => '',
                'name'         => 'Ice Time',
                'level'        => 30,
                'description'  => 'Kuzan congela metade do próprio corpo, criando o mecanismo perfeito de defesa e ataque. Ele permanece nesse estado por 2 segundos, se tornando invulnerável, e se ele receber um ataque durante esse tempo, seu corpo congelado se quebrará. Como resultado, ele se torna imparável, invisível e ganha bônus de velocidade de movimento de 400 por 1,2 segundos. Em seguida, Kuzan se materializa novamente, atacando a área ao seu redor, causando dano e congelando os inimigos 2 segundos. Se usado em instâncias não-PvP, os inimigos ao redor de Kuzan ficarão silenciados por 1,8 segundos depois que ele desaparecer.',
                'video'        => '',
                'recharge'     => 30,
                'energy'       => null,
                'pve_power'    => 30,
                'pvp_power'    => 20,
            ],
            [
                'character_id' => 1,
                'icon'         => '',
                'name'         => 'Ice Time Capsule',
                'level'        => 40,
                'description'  => 'Kuzan pisa firmemente no chão, liberando uma rajada de ar frio em direção aos seus aliados, criando uma armadura de gelo em volta deles, o que os torna invulneráveis a qualquer dano recebido por 2 segundos.',
                'video'        => '',
                'recharge'     => 60,
                'energy'       => null,
                'pve_power'    => null,
                'pvp_power'    => null,
            ],
            [
                'character_id' => 1,
                'icon'         => '',
                'name'         => 'Ice Star',
                'level'        => 50,
                'description'  => 'Kuzan cria uma grande tempestade de neve ao seu redor, formando estacas de gelo tão afiadas quanto espadas. A tempestade gera um poderoso vórtice de vento que atrai os inimigos próximos em direção a Kuzan, causando dano e atordoando-os por 1,5 segundo. No entanto, contra jogadores, a duração é reduzida para 1 segundo.',
                'video'        => '',
                'recharge'     => 45,
                'energy'       => -50,
                'pve_power'    => 20,
                'pvp_power'    => 10,
            ],
            [
                'character_id' => 1,
                'icon'         => '',
                'name'         => 'Ice Block: Pheasant Beak',
                'level'        => 70,
                'description'  => 'Kuzan congela um de seus braços e o aponta para frente. Em seguida, ele libera uma enorme onda de gelo em forma de faisão de seu braço, impulsionando-a para frente para infligir dano a todos os inimigos em seu caminho. O faisão explodirá após um certo tempo ou se colidir com um obstáculo, causando dano aos inimigos presos na explosão e empurrando-os para trás. Além disso, qualquer inimigo atingido por essa habilidade terá sua velocidade de movimento reduzida em 100 por 4 segundos.',
                'video'        => '',
                'recharge'     => 45,
                'energy'       => -30,
                'pve_power'    => 50,
                'pvp_power'    => 30,
            ],
            [
                'character_id' => 1,
                'icon'         => '',
                'name'         => 'Ice Age',
                'level'        => 90,
                'description'  => 'Kuzan se agacha e coloca a mão no chão, congelando uma área massiva ao seu redor. Qualquer inimigo pego dentro dessa área receberá dano e será congelado por 2 segundos.',
                'video'        => '',
                'recharge'     => 120,
                'energy'       => -60,
                'pve_power'    => 70,
                'pvp_power'    => 50,
            ],
            [
                'character_id' => 1,
                'icon'         => '',
                'name'         => 'Freezing Temperature (Passiva)',
                'level'        => 25,
                'description'  => 'Kuzan gera acúmulos de gelo ao acertar suas habilidades: Ice Saber, Ice Block: Partisan, concedendo 1 acúmulo cada, enquanto Ice Ball e Ice Block: Pheasant Beak concede 2 acúmulos. Uma vez que Kuzan atinge 4 acúmulos de gelo, se ele usar qualquer uma das habilidades mencionadas, ele congelará os oponentes por 2 segundos.',
                'video'        => '',
                'recharge'     => null,
                'energy'       => null,
                'pve_power'    => null,
                'pvp_power'    => null,
            ],
            [
                'character_id' => 1,
                'icon'         => '',
                'name'         => 'Emote',
                'level'        => 25,
                'description'  => null,
                'video'        => '',
                'recharge'     => 1,
                'energy'       => null,
                'pve_power'    => null,
                'pvp_power'    => null,
            ],
        ];

        DB::table('skills')->insert([
            ...$data,
        ]);
    }
}
