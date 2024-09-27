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
        Schema::create('domain_domain', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->decimal('amount', 11)->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('post_code');
            $table->string('city');
            $table->dateTime('expiry_date', 6)->nullable();
            $table->dateTime('upgrade_date', 6)->nullable();
            $table->dateTime('last_upgrade_date', 6)->nullable();
            $table->boolean('paid')->nullable()->default(false);
            $table->boolean('completed')->nullable()->default(false);
            $table->boolean('successful')->nullable()->default(false);
            $table->boolean('status')->nullable()->default(false);
            $table->boolean('is_new')->nullable()->default(false);
            $table->boolean('whois_synced')->nullable();
            $table->foreignId('payment_id')->nullable()->constrained('account_payment')->onDelete('set null');
            $table->foreignId('partner_id')->nullable()->constrained('partner_partner')->onDelete('set null');
            $table->foreignId('country_id')->nullable()->constrained('core_country')->onDelete('set null');
            $table->foreignId('price_id')->nullable()->constrained('domain_price')->onDelete('set null');

            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('deleted_by')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domain_domain');
    }
};
