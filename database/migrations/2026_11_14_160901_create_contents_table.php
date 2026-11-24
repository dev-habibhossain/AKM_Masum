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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->foreignId('category_id')
                ->nullable()
                ->constrained('content_categories')
                ->nullOnDelete();

            $table->string('title', 180);
            $table->string('slug', 191)->unique();
            $table->text('description')->nullable();

            $table->string('locale', 5)->default('bn');
            $table->string('status', 25)->default('draft');
            $table->string('visibility', 20)->default('public');

            $table->boolean('is_featured')->default(false);
            $table->timestamp('published_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('status');
            $table->index('visibility');
            $table->index('published_at');
            $table->index('is_featured');
            $table->index(['status', 'visibility', 'published_at']);
            $table->index(['user_id', 'status', 'visibility']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
