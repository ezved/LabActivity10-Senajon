<?php

// migration tools
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // build the authors table
    public function up(): void
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id();                       // auto-increment primary key
            $table->string('name');             // author full name
            $table->string('position');         // e.g. Kagawad, Barangay Secretary, BHW
            $table->string('email')->unique();  // no two authors share an email
            $table->timestamps();               // created_at and updated_at
        });
    }

    // undo: drop the authors table
    public function down(): void
    {
        Schema::dropIfExists('authors');
    }
};
