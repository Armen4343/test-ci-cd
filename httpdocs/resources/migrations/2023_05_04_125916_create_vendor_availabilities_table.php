<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_availabilities', function (Blueprint $table) {
            $table->id();
			
			$table->unsignedBigInteger('vendor_id');
            $table->foreign('vendor_id')->references('id')->on('users')->onDelete('cascade');
			$table->tinyInteger('status')->default('0');
			$table->time('sunday_open')->nullable();
			$table->time('sunday_close')->nullable();
			$table->time('monday_open')->nullable();
			$table->time('monday_close')->nullable();
			$table->time('tuesday_open')->nullable();
			$table->time('tuesday_close')->nullable();
			$table->time('wednesday_open')->nullable();
			$table->time('wednesday_close')->nullable();
			$table->time('thursday_open')->nullable();
			$table->time('thursday_close')->nullable();
			$table->time('friday_open')->nullable();
			$table->time('friday_close')->nullable();
			$table->time('saturday_open')->nullable();
			$table->time('saturday_close')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendor_availabilities');
    }
};
