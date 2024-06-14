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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('buyer_id');
            $table->unsignedBigInteger('vendor_id');
			$table->float('rating', 3, 2);
            $table->text('comment');
            $table->text('reply')->nullable();
            $table->integer('status')->default('1');
            $table->string('order_number')->nullable();
            $table->timestamps();
			 $table->foreign('buyer_id')->references('id')->on('users')->onDelete('cascade');
			 $table->foreign('vendor_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ratings');
    }
};
