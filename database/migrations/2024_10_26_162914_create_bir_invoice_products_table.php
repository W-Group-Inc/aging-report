<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBirInvoiceProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bir_invoice_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('DocNum');
            $table->string('Description')->nullable();
            $table->integer('Packing')->nullable();
            $table->integer('Unit')->nullable();
            $table->integer('Quantity')->nullable();
            $table->string('UnitPrice')->nullable();
            $table->string('Amount')->nullable();
            $table->string('Uom')->nullable();
            $table->string('printUom')->nullable();
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
        Schema::dropIfExists('bir_invoice_products');
    }
}
