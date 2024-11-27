<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToBirInvoiceProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bir_invoice_products', function (Blueprint $table) {
            $table->string('SupplierCode')->nullable();
            $table->string('DocCur')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bir_invoice_products', function (Blueprint $table) {
            $table->dropColumn(['SupplierCode', 'DocCur']);
        });
    }
}
