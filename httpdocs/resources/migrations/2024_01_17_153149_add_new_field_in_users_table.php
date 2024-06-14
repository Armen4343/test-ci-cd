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
        Schema::table('users', function (Blueprint $table) {
            $table->string('company_name')->nullable()->after('vendor_payment_password');
            $table->string('tax_id')->nullable()->after('company_name');
            $table->string('vat_number')->nullable()->after('tax_id');
            $table->string('sdi_code')->nullable()->after('vat_number');
            $table->string('pec')->nullable()->after('sdi_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('company_name');
            $table->dropColumn('tax_id');
            $table->dropColumn('vat_number');
            $table->dropColumn('sdi_code');
            $table->dropColumn('pec');
        });
    }
};
