<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('DocNum')->unique();
            $table->string('SoldTo')->nullable();
            $table->string('Address')->nullable();
            $table->string('Tin')->nullable();
            $table->string('BusinessStyle')->nullable();
            $table->date('InvoiceDate');
            $table->string('BuyersPo')->nullable();
            $table->string('SalesContractNo')->nullable();
            $table->string('TermsOfPayment')->nullable();
            $table->date('InvoiceDueDate');
            $table->string('OscaPwd')->nullable();
            $table->string('ScPwd')->nullable();
            $table->string('Currency')->nullable();
            $table->string('Uom')->nullable();
            $table->string('Remarks', 1000)->nullable();
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
        Schema::dropIfExists('sales_invoices');
    }
}
