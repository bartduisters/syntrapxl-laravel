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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('teaser')->nullable();
            $table->float('price_excl')->nullable();
            $table->float('price_incl')->nullable();

            $table->string('media_url')->nullable();
            $table->boolean('is_business')->default(false);
            $table->text('program_text')->nullable();

            $table->foreignId('kmo_theme_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sector_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_type_id')->constrained()->cascadeOnDelete();
            $table->foreignId('duration_id')->constrained()->cascadeOnDelete();
            $table->foreignId('level_id')->constrained()->cascadeOnDelete();
            $table->foreignId('study_type_id')->constrained()->cascadeOnDelete();


            $table->text('details_text')->nullable();
            $table->text('details_extra_info')->nullable();
            $table->text('details_for_text')->nullable();
            $table->text('details_requirements_text')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
