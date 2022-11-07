<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashInsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_in', function (Blueprint $table) {
            $table->id();
            $table->integer('inv_id');
            $table->date('cash_in_date');
            $table->integer('nominal_cash_in');
            $table->integer('nominal_ppn');
            $table->integer('nominal_pph');
            $table->string('bukti_uang_masuk');
            $table->string('bank_penerima');
            $table->string('deskripsi');
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
        Schema::dropIfExists('cash_ins');
    }
}
