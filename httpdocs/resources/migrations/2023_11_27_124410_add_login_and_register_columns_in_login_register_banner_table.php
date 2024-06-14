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
        Schema::table('login_register_banner', function (Blueprint $table) {
            $table->string('login_banner')->nullable()->after('id');
            $table->string('register_banner')->nullable()->after('login_banner');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('login_register_banner', function (Blueprint $table) {
            $table->dropColumn('login_banner');
            $table->dropColumn('register_banner');
        });
    }
};
