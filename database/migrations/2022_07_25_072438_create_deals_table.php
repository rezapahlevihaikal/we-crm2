<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('author');
            $table->integer('id_core_bisnis');
            $table->integer('id_company');
            $table->integer('size');
            $table->date('start_date');
            $table->date('end_date');
            $table->date('expired_date');
            $table->integer('id_source');
            $table->integer('id_stage');
            $table->integer('id_product');
            $table->string('invoice_number');
            $table->text('description');
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
        Schema::dropIfExists('deals');
    }
}
