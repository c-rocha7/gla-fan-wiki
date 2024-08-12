<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->string('icon');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('level');
            $table->smallInteger('min_attack')->nullable();
            $table->smallInteger('max_attack')->nullable();
            $table->smallInteger('min_defense')->nullable();
            $table->smallInteger('max_defense')->nullable();
            $table->smallInteger('min_vitality')->nullable();
            $table->smallInteger('max_vitality')->nullable();
            $table->smallInteger('min_critical')->nullable();
            $table->smallInteger('max_critical')->nullable();
            $table->smallInteger('min_experience')->nullable();
            $table->smallInteger('max_experience')->nullable();
            $table->smallInteger('min_luck')->nullable();
            $table->smallInteger('max_luck')->nullable();
            $table->smallInteger('min_armor_penetration')->nullable();
            $table->smallInteger('max_armor_penetration')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};
