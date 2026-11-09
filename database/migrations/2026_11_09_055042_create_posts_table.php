<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // build the posts table (runs after authors because of the timestamp)
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            // every post belongs to an author; deleting the author deletes the posts
            $table->foreignId('author_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('category');
            $table->text('body');
            $table->boolean('is_published')->default(false);
            $table->boolean('is_pinned')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    // undo: drop the posts table
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
