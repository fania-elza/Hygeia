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
            $table->string('product_id', 10)->unique(); // Product ID unik, max 10 karakter (misal: PRC001)
            $table->string('name'); // Product Name
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // Relasi ke categories
            $table->decimal('price', 10, 2); // Price
            $table->integer('stock'); // Stock
            $table->text('description')->nullable(); // Description
            $table->string('image')->nullable(); // Image path (nullable)
            $table->enum('status', ['active', 'inactive'])->default('active'); // Status
            $table->timestamps();
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
