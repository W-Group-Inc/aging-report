<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesInvoiceProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_invoice_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('DocNum');
            $table->string('Description')->nullable();
            $table->integer('Quantity')->nullable();
            $table->string('UnitPrice')->nullable();
            $table->string('Amount')->nullable();
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
        Schema::dropIfExists('sales_invoice_products');
    }
}
