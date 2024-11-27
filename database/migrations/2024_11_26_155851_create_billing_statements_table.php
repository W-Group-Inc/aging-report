<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingStatementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_statements', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('DocNum')->unique();
            $table->string('BilledTo')->nullable();
            $table->string('Soa')->nullable();
            $table->date('Date')->nullable();
            $table->string('Subject')->nullable();
            $table->string('Currency')->nullable();
            $table->string('TermsOfPayment')->nullable();
            $table->string('DueDate')->nullable();
            $table->string('AccountName')->nullable();
            $table->string('AccountNumber')->nullable();
            $table->string('Bank')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billing_statements');
    }
}
