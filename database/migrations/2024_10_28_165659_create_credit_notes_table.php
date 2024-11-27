<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_notes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Client')->nullable();
            $table->string('ClientAddress')->nullable();
            $table->string('Tin')->nullable();
            $table->string('BusinessStyle')->nullable();
            $table->date('Date')->nullable();
            $table->string('Reference')->nullable();
            $table->string('Label1')->nullable();
            $table->string('Label2')->nullable();
            $table->string('Label3')->nullable();
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
        Schema::dropIfExists('credit_notes');
    }
}
