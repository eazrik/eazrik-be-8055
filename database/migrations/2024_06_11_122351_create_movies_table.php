<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image');
            $table->string('genre')->nullable();
            $table->string('performer')->nullable();
            $table->string('director')->nullable();
            $table->string('theater_name')->nullable();
            $table->unsignedInteger('views')->nullable();
            $table->unsignedInteger('likes')->nullable();
            $table->unsignedInteger('ratings')->nullable();
            $table->datetime('release')->nullable();
            $table->datetime('start_at')->nullable();
            $table->datetime('end_at')->nullable();
            $table->time('length')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
