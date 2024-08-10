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
        Schema::create('domain_registrar', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('name');
            $table->longText('description');
            $table->longText('params')->nullable();
            $table->integer('test')->nullable();
            $table->string('file_path')->nullable();
            $table->boolean('published')->nullable()->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domain_registrar');
    }
};
