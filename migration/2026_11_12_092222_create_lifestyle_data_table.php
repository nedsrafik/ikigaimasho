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
       Schema::create('lifestyle_data', function (Blueprint $table) {
        $table->id();

        // Connect each record to its user
        $table->foreignId('user_id')
              ->constrained()
              ->cascadeOnDelete();

        $table->date('record_date');

        // Daily lifestyle information
        $table->decimal('sleep_hours', 5, 2)->nullable();
        $table->decimal('screen_time_hours', 5, 2)->nullable();
        $table->decimal('study_hours', 5, 2)->nullable();
        $table->decimal('exercise_minutes', 6, 2)->nullable();
       

        $table->timestamps();

        // One record per user per day
        $table->unique(['user_id', 'record_date']);
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lifestyle_data');
    }
};
