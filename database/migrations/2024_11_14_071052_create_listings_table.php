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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->string('position');
            $table->string('location');
            $table->integer('min_salary');
            $table->integer('max_salary');
            $table->integer("min_age");
            $table->integer("max_age");
            $table->string('education');
            $table->json('requirements')->nullable();
            $table->json('description')->nullable();
            $table->string('company');
            $table->string('email');
            $table->string('type');
            $table->string('experience');
            $table->json('skills');
            $table->string('arrangement');
            $table->string('hours')->nullable();
            $table->string('duration')->nullable();
            $table->foreignId('employer_id')->references('id')->on('employers');
            $table->foreignId('companyID')->references('id')->on('companies');
            $table->string('status')->default('open');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
