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
        Schema::create('children', function (Blueprint $table) {
            $table->id();

            $table->string('card_tag')->nullable();

            $table->string('full_name');

            $table->text('address');
            $table->string('rt', 5);
            $table->string('rw', 5);

            $table->string('family_card_number', 20);
            $table->string('national_id', 20)->unique();

            $table->enum('gender', ['Male', 'Female']);

            $table->string('birth_place');
            $table->date('birth_date');

            $table->string('religion')->nullable();
            $table->string('education')->nullable();
            $table->string('occupation')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('family_relationship')->nullable();

            $table->string('father_name');
            $table->string('mother_name');

            $table->boolean('is_resident')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('children');
    }
};
