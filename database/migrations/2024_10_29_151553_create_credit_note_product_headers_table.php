<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditNoteProductHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_note_product_headers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('CreditNoteId');
            $table->string('Header1')->nullable();
            $table->string('Header2')->nullable();
            $table->string('Header3')->nullable();
            $table->string('Header4')->nullable();
            $table->string('Header5')->nullable();
            $table->string('Header6')->nullable();
            $table->string('Header7')->nullable();
            $table->string('Header8')->nullable();
            $table->string('Header9')->nullable();
            $table->string('Header10')->nullable();
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
        Schema::dropIfExists('credit_note_product_headers');
    }
}
