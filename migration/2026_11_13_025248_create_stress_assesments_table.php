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
    Schema::create('stress_assessments', function (Blueprint $table) {
        $table->id();

        $table->foreignId('user_id')
              ->constrained()
              ->cascadeOnDelete();

        $table->date('assessment_date');

        // PSS-10 responses (0 to 4)
        for ($i = 1; $i <= 10; $i++) {
            $table->unsignedTinyInteger('q' . $i);
        }

        // Total PSS-10 score (0 to 40)
        $table->unsignedTinyInteger('total_score');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stress_assesments');
    }
};
