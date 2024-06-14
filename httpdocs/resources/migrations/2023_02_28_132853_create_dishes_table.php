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
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
			$table->string("name");
			$table->string("image");
			$table->boolean("status")->defualt(1);//published(1), unpublished(0)
			$table->double("price");
			$table->integer("quantity");
			$table->text("description")->nullable();
			$table->unsignedBigInteger('dish_category_id');
            $table->foreign('dish_category_id')
                     ->references('id')->on('dish_categories')->onDelete('cascade');
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
        Schema::dropIfExists('dishes');
    }
};
