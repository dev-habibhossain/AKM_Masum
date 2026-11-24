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
        Schema::create('moderator_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')
                ->restrictOnDelete();
            $table->string('username', 60)->unique();
            $table->string('display_name', 120);
            $table->text('bio')->nullable();
            $table->string('avatar_path', 255)->nullable();
            $table->json('contact_information')->nullable();
            $table->string('availability_status', 20)->default('available');
            $table->timestamp('last_seen_at')->nullable();
            $table->timestamps();

            $table->index('availability_status');
            $table->index('last_seen_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moderator_profiles');
    }
};
