<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnsToBirInvoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bir_invoices', function (Blueprint $table) {
            $table->date('DateOfShipment')->nullable();
            $table->string('PortOfLoading')->nullable();
            $table->string('PortOfDestination')->nullable();
            $table->string('ModeOfShipment')->nullable();
            $table->string('TermsOfDelivery')->nullable();
            $table->string('FedderVessel')->nullable();
            $table->string('OceanVessel')->nullable();
            $table->string('BillOfLading')->nullable();
            $table->string('ContainerNo')->nullable();
            $table->string('SealNo')->nullable();
            $table->string('TermsOfPayment')->nullable();
            $table->date('InvoiceDueDate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bir_invoices', function (Blueprint $table) {
            $table->dropColumn('DateOfShipment');
            $table->dropColumn('PortOfLoading');
            $table->dropColumn('PortOfDestination');
            $table->dropColumn('ModeOfShipment');
            $table->dropColumn('TermsOfDelivery');
            $table->dropColumn('FedderVessel');
            $table->dropColumn('OceanVessel');
            $table->dropColumn('BillOfLading');
            $table->dropColumn('ContainerNo');
            $table->dropColumn('SealNo');
            $table->dropColumn('TermsOfPayment');
            $table->dropColumn('InvoiceDueDate');
        });
    }
}
