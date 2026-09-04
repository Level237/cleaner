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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
    $table->foreignId('parent_id')->nullable()->constrained('categories')->nullOnDelete();
    $table->string('name');
    $table->string('slug')->unique();
    $table->text('description')->nullable();
    $table->boolean('is_visible')->default(true);
    $table->integer('position')->default(0);
    
    // Image principale
    $table->string('image_path')->nullable();
    $table->string('image_alt')->nullable();
    
    // SEO
    $table->string('seo_title')->nullable();
    $table->string('seo_description', 500)->nullable();
    $table->string('canonical_url')->nullable();
    $table->string('og_image_path')->nullable(); // Pour partage social
    
    $table->timestamps();
    $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
