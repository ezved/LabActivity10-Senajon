<?php

// migration tools
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Kapitan wants a view counter, so add a views column to posts
    public function up(): void
    {
        // Schema::table changes an existing table
        Schema::table('posts', function (Blueprint $table) {
            // starts at 0, placed right after the body column
            $table->unsignedInteger('views')->default(0)->after('body');
        });
    }

    // undo: remove the views column
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // delete the column we added
            $table->dropColumn('views');
        });
    }
};
