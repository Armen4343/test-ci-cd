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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('google_id')->nullable();
            $table->string('facebook_id')->nullable();
            $table->string('name');
            $table->string('manager_name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->longText('token')->nullable();
            $table->string('password')->nullable();
            $table->string('vendor_payment_password')->nullable();
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('role')->nullable();
            $table->string('status')->default('active');
            $table->string('termsandconditions')->default('no');
            $table->string('disable_restaurant')->default('no');
            $table->string('business_description')->nullable();
            $table->longText('address')->nullable();
            $table->string('street_number')->nullable();
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->string('banner_photo_path', 2048)->nullable();
			$table->string('provider')->nullable();
			$table->string('provider_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};