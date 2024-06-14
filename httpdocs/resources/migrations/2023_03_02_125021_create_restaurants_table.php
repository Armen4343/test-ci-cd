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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
			$table->string("name");	
			$table->string("image");		
			$table->string("cover_image");		
			$table->double("min_delivery_time");		
			$table->double("max_delivery_time");		
			$table->string("license");		
			$table->text("short_description");		
			$table->text("address");
			$table->string("logitude");		
			$table->string("latitude");		
			$table->string("phone");		
			$table->double("min_order_price");				
			$table->boolean("status")->defualt(1);//published(1), unpublished(0)
			$table->unsignedBigInteger('vendor_id');
            $table->foreign('vendor_id')
                     ->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('restaurants');
    }
};
