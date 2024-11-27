<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtraColumnsToBirInvoiceProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bir_invoice_products', function (Blueprint $table) {
            $table->string('ProductCode')->nullable();
            $table->string('PbiSiType')->nullable();
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
            $table->dropColumn('ProductCode');
            $table->dropColumn('PbiSiType');
        });
    }
}
