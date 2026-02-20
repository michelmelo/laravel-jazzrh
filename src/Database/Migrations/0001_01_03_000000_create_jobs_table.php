<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('location');
            $table->decimal('salary_min', 12, 2)->nullable();
            $table->decimal('salary_max', 12, 2)->nullable();
            $table->enum('contract_type', ['clt', 'pj', 'temporary', 'internship'])->default('clt');
            $table->enum('seniority_level', ['junior', 'mid-level', 'senior'])->default('mid-level');
            $table->enum('status', ['draft', 'published', 'closed'])->default('draft');
            $table->foreignId('posted_by')->constrained('users')->onDelete('cascade');
            $table->timestamp('posted_at')->nullable();
            $table->timestamp('closes_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('status');
            $table->index('posted_by');
            $table->index('category_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
