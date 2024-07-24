<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('character_id')->constrained()->cascadeOnDelete();
            $table->string('icon');
            $table->string('name');
            $table->string('level');
            $table->text('description')->nullable();
            $table->string('video');
            $table->tinyInteger('recharge')->nullable();
            $table->integer('energy')->nullable();
            $table->float('pve_power')->nullable();
            $table->float('pvp_power')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};
