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
        Schema::create('internships', function (Blueprint $table) {
            $table->id();
            $table->string('location');
            $table->string('salary');
            $table->string("age");
            $table->string('education');
            $table->json('requirements')->nullable();
            $table->json('description')->nullable();
            $table->string('company');
            $table->string('skills');
            $table->string('email');
            $table->string('arrangement');
            $table->string('duration');
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
        Schema::dropIfExists('internships');
    }
};
