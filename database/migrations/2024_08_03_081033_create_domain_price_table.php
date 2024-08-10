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
        Schema::create('domain_price', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->decimal('price', 11);
            $table->string('tld');
            $table->integer('ordering')->nullable();
            $table->boolean('published')->nullable()->default(false);
            $table->foreignId('registrar_id')->constrained('domain_registrar')->onDelete('cascade')->nullable()->index('registrar_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domain_price');
    }
};
