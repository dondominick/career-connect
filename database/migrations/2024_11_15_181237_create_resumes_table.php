<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use League\CommonMark\Reference\Reference;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicant_id')->references('id')->on('applicants');
            $table->string('name');
            $table->string('gender');
            $table->integer('age');
            $table->string('email');
            $table->string('contact_no');
            $table->string('address');
            $table->string('education');
            $table->string('undergrad')->nullable();
            $table->string('skills')->nullable();
            $table->json('work')->nullable();
            $table->json('educational_background')->nullable();
            $table->json('reference')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resumes');
    }
};
