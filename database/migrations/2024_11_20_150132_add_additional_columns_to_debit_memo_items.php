<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalColumnsToDebitMemoItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('debit_memo_items', function (Blueprint $table) {
            $table->string('ListNo')->nullable();
            $table->integer('Quantity')->nullable();
            $table->string('Unit')->nullable();
            $table->decimal('UnitPrice', 20, 2)->nullable();
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
        Schema::table('debit_memo_items', function (Blueprint $table) {
            $table->dropColumn('ListNo');
            $table->dropColumn('Quantity');
            $table->dropColumn('Unit');
            $table->dropColumn('UnitPrice');
            $table->dropColumn('Currency');
        });
    }
}
