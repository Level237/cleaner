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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('name');
    $table->string('slug')->unique();
    $table->string('sku')->nullable()->unique();
    $table->text('short_description')->nullable();
    $table->longText('description')->nullable();

    // Publication
    $table->string('status')->default('draft'); // draft, published, archived
    $table->timestamp('published_at')->nullable();
    $table->boolean('is_featured')->default(false);
    $table->boolean('is_new')->default(false);

    // Classification
    $table->foreignId('primary_category_id')
        ->nullable()
        ->constrained('categories')
        ->nullOnDelete();
    
        

    $table->string('tea_family')->nullable(); // vert, noir, blanc, oolong, matcha, infusion...
    $table->string('origin')->nullable();
    $table->string('harvest')->nullable();
    $table->json('tasting_notes')->nullable();
    $table->json('ingredients')->nullable();
    $table->integer('brewing_temp_celsius')->nullable();
    $table->string('brewing_time')->nullable();
    $table->string('caffeine_level')->nullable();
    $table->json('badges')->nullable();

    // Commerce
    $table->decimal('price', 10, 2)->default(0);
    $table->decimal('compare_price', 10, 2)->nullable();
    $table->string('currency', 3)->default('EUR');
    $table->string('stock_status')->default('in_stock'); // in_stock, out_of_stock, preorder
    $table->unsignedInteger('stock_quantity')->nullable();

    // SEO
    $table->string('seo_title')->nullable();
    $table->string('seo_description', 500)->nullable();
    $table->string('canonical_url')->nullable();
    $table->string('og_image_path')->nullable();
    $table->json('structured_data')->nullable();
    $table->json('meta')->nullable();

    $table->timestamps();
    $table->softDeletes();

    $table->index(['status', 'published_at']);
    $table->index('tea_family');
    $table->index('is_featured');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
