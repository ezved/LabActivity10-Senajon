<?php

// migration tools
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // build the posts table (runs after authors because of the timestamp)
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();                                   // auto-increment primary key
            // every post belongs to an author; deleting the author deletes the posts
            $table->foreignId('author_id')->constrained()->cascadeOnDelete();
            $table->string('title');                        // post title
            $table->string('category');                     // one of the 5 categories
            $table->text('body');                           // long text of the post
            $table->boolean('is_published')->default(false);  // drafts by default
            $table->boolean('is_pinned')->default(false);     // not pinned by default
            $table->timestamp('published_at')->nullable();    // empty for drafts
            $table->timestamps();                           // created_at and updated_at
        });
    }

    // undo: drop the posts table
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
