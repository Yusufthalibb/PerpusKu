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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('isbn', 20)->unique();
            $table->string('title');
            $table->string('author');
            $table->string('publisher');
            $table->year('year');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->integer('pages');
            $table->string('shelf_code', 20);
            $table->text('description')->nullable();
            $table->integer('stock');
            $table->string('image')->nullable(); // Untuk sampul buku
            $table->enum('status', ['tersedia', 'dipinjam', 'rusak'])->default('tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};