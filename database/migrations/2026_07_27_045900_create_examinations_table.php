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
        Schema::create('examinations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('child_id')
                ->constrained('children')
                ->cascadeOnDelete();

            $table->foreignId('staff_id')
                ->constrained('staff')
                ->cascadeOnDelete();

            $table->foreignId('activity_id')
                ->constrained('activities')
                ->cascadeOnDelete();

            // Growth
            $table->decimal('weight',5,2)->nullable();
            $table->string('weight_result')->nullable();
            $table->string('weight_for_age')->nullable();

            $table->decimal('height',5,2)->nullable();
            $table->string('height_for_age')->nullable();
            $table->string('weight_for_height')->nullable();

            $table->decimal('head_circumference',5,2)->nullable();
            $table->string('head_circumference_status')->nullable();

            $table->decimal('upper_arm_circumference',5,2)->nullable();
            $table->string('upper_arm_status')->nullable();

            // Development
            $table->boolean('development_check')->default(false);

            // Symptoms
            $table->boolean('cough_two_weeks')->default(false);
            $table->boolean('fever_two_weeks')->default(false);
            $table->boolean('weight_not_increasing')->default(false);
            $table->boolean('tb_contact')->default(false);

            // Nutrition
            $table->boolean('exclusive_breastfeeding')->default(false);
            $table->boolean('complementary_feeding')->default(false);

            // Health Services
            $table->string('immunization')->nullable();
            $table->boolean('vitamin_a')->default(false);
            $table->boolean('deworming')->default(false);
            $table->boolean('local_food_program')->default(false);
            $table->boolean('health_education')->default(false);

            // Notes
            $table->text('illness_symptoms')->nullable();
            $table->text('referral')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examinations');
    }
};
