<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('path');
            $table->string('type', 50);
            $table->unsignedBigInteger('size');
            $table->foreignId('applicant_id')->nullable()->constrained('applicants')->onDelete('set null');
            $table->foreignId('job_id')->nullable()->constrained('jobs')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
