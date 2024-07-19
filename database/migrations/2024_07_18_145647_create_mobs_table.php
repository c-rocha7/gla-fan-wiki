<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('mobs', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('name');
            $table->string('slug')->unique();
            $table->integer('life');
            $table->integer('attack');
            $table->integer('defense');
            $table->integer('speed');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mobs');
    }
};
