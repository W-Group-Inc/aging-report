<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingStatementProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_statement_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('DocNum');
            $table->string('Particulars')->nullable();
            $table->string('DatePeriod')->nullable();
            $table->string('DocRef')->nullable();
            $table->decimal('Amount', 15, 2)->nullable();
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
        Schema::dropIfExists('billing_statement_products');
    }
}
