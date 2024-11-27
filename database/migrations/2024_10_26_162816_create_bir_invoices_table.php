<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBirInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bir_invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('DocNum')->unique();
            $table->string('SoldTo')->nullable();
            $table->string('Address')->nullable();
            $table->string('Tin')->nullable();
            $table->string('BusinessStyle')->nullable();
            $table->string('BuyersPo')->nullable();
            $table->string('BuyersRef')->nullable();
            $table->string('SalesContract')->nullable();
            $table->string('OscaPwd')->nullable();
            $table->string('ScPwd')->nullable();
            $table->string('PaymentInstruction', 1000)->nullable();
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
        Schema::dropIfExists('bir_invoices');
    }
}
