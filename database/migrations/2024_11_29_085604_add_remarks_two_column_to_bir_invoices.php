<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRemarksTwoColumnToBirInvoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bir_invoices', function (Blueprint $table) {
            $table->string('RemarksTwo')->nullable();
            $table->string('Currency')->nullable();
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
            $table->dropColumn('RemarksTwo');
            $table->dropColumn('Currency');
        });
    }
}
