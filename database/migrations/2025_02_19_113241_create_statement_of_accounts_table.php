<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatementOfAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statement_of_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('DocNum')->unique();
            $table->string('SoaNo')->nullable();
            $table->date('InvoiceDate')->nullable();
            $table->string('SoldTo')->nullable();
            $table->string('Address')->nullable();
            $table->string('VatNumber')->nullable();
            $table->string('BuyersPo')->nullable();
            $table->string('BuyersRef')->nullable();
            $table->string('SalesContractNo')->nullable();
            $table->string('OscaPwd')->nullable();
            $table->string('ScPwd')->nullable();
            $table->string('Currency')->nullable();
            $table->string('PackingUnit')->nullable();
            $table->string('Uom')->nullable();
            $table->string('UnitPriceUom')->nullable();
            $table->date('DateOfShipment')->nullable();
            $table->string('PlaceOfLoading')->nullable();
            $table->string('PlaceOfDelivery')->nullable();
            $table->string('ModeOfShipment')->nullable();
            $table->string('TermsOfDelivery')->nullable();
            $table->string('FeederVessel')->nullable();
            $table->string('OceanVessel')->nullable();
            $table->string('AirwayBillNo')->nullable();
            $table->string('ContainerNo')->nullable();
            $table->string('SealNo')->nullable();
            $table->string('TermsOfPayment')->nullable();
            $table->date('InvoiceDueDate')->nullable();
            $table->string('Type')->nullable();
            $table->string('PaymentInstruction', 1000)->nullable();
            $table->string('Tin')->nullable();
            $table->string('BusinessStyle')->nullable();
            $table->date('PickupDate')->nullable();
            $table->string('Phrex', 1000)->nullable();
            $table->smallInteger('ShowPhrex')->nullable();

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
        Schema::dropIfExists('statement_of_accounts');
    }
}
