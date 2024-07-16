<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('character_id')->constrained();
            $table->string('image');
            $table->string('name');
            $table->tinyInteger('level');
            $table->text('description');
            $table->string('video');
            $table->tinyInteger('recharge');
            $table->integer('energy');
            $table->float('pve_power');
            $table->float('pvp_power');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};
