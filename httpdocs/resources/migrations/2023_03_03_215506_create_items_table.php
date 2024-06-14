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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('cuisine_id');
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->string('alergen_info')->nullable();
            $table->boolean("menu_status")->defualt(1);//published(1), unpublished(0)
            $table->string('discount')->nullable();
            $table->string('price')->nullable();
            $table->string('date_range')->nullable();
            $table->string('quantity')->nullable();
            $table->string('promo')->nullable();
            $table->string('tax')->nullable();
            $table->string('tax_included')->default('0');
            $table->string('expire_date')->nullable();
            $table->string('availability')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('cuisine_id')->references('id')->on('cuisines')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
};
