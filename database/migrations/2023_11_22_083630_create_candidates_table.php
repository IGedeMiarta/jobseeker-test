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
        Schema::create('t_candidate', function (Blueprint $table) {
            $table->id('candidate_id');
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->string('full_name');
            $table->string('dob')->comment('date of birth');
            $table->string('pob')->comment('place of birth');
            $table->string('gender')->comment(' F for female, M for Male');
            $table->string('year_exp')->comment('years of experience');
            $table->string('last_salary');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
