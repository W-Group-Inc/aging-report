<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtraColumnsToBirInvoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bir_invoices', function (Blueprint $table) {
            $table->string('ShipTo')->nullable();
            $table->string('SoNo')->nullable();
            $table->string('DrNo')->nullable();
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
            $table->dropColumn('ShipTo');
            $table->dropColumn('SoNo');
            $table->dropColumn('DrNo');

        });
    }
}
