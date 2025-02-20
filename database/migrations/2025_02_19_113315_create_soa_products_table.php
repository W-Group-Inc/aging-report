<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoaProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soa_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('DocNum');
            $table->string('Description')->nullable();
            $table->integer('Packing')->nullable();
            $table->integer('Unit')->nullable();
            $table->float('Quantity')->nullable();
            $table->string('UnitPrice')->nullable();
            $table->float('Amount')->nullable();
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
        Schema::dropIfExists('soa_products');
    }
}
