<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditNoteProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_note_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('CreditNoteId');
            $table->string('Label1')->nullable();
            $table->string('Label2')->nullable();
            $table->string('Label3')->nullable();
            $table->string('Label4')->nullable();
            $table->string('Label5')->nullable();
            $table->string('Label6')->nullable();
            $table->string('Label7')->nullable();
            $table->string('Label8')->nullable();
            $table->string('Label9')->nullable();
            $table->string('Label10')->nullable();
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
        Schema::dropIfExists('credit_note_products');
    }
}
