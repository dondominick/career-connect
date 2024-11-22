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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->foreignId('applicant_id')->references('id')->on('applicants');
            $table->integer('listing_id');
            $table->foreignId('employer_id')->references('id')->on('employers');
            $table->foreignId('companyID')->references('id')->on('companies');
            $table->json('resume');
            $table->string('status')->default('processing');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
