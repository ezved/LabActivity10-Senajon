<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Kapitan wants a view counter, so add a views column to posts
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedInteger('views')->default(0)->after('body');
        });
    }

    // undo: remove the views column
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('views');
        });
    }
};
