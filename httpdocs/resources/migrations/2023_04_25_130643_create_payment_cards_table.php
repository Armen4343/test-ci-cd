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
        Schema::create('payment_cards', function (Blueprint $table) {
            $table->id();
			$table->string('name_on_card');
			$table->string('card_number');
			$table->string('cvv');
			$table->string('card_type');
			$table->date('expiration_date');
			$table->boolean("status")->defualt(1);//Active(1), Disbaled(0)
			
           $table->unsignedBigInteger('buyer_id');
            $table->foreign('buyer_id')
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
        Schema::dropIfExists('payment_cards');
    }
};
