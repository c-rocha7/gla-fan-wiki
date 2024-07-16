<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->tinyInteger('level');
            $table->tinyInteger('min_vitality');
            $table->tinyInteger('max_vitality');
            $table->tinyInteger('min_defense');
            $table->tinyInteger('max_defense');
            $table->tinyInteger('min_experience');
            $table->tinyInteger('max_experience');
            $table->tinyInteger('min_luck');
            $table->tinyInteger('max_luck');
            $table->tinyInteger('min_attack');
            $table->tinyInteger('max_attack');
            $table->tinyInteger('min_armor_penetration');
            $table->tinyInteger('max_armor_penetration');
            $table->tinyInteger('min_critical');
            $table->tinyInteger('max_critical');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
