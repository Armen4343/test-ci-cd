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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
			$table->string("title");
			$table->boolean("status")->defualt(1);//published(1), unpublished(0)
			$table->unsignedBigInteger('vendor_id');
            $table->unsignedBigInteger('category_id')->nullable();
			$table->string("price_type")->nullable();
 			$table->float('price', 10, 2)->nullable();	
			$table->string('tax')->nullable();
            $table->foreign('vendor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('menus');
    }
};
