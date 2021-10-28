<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerkembangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perkembangans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pesanan_id')->unsigned()->nullable(true);
            $table->foreign('pesanan_id')->references('id')->on('pesanan_rumahs');
            $table->dateTime('tanggal');
            $table->text('keterangan')->nullable(true)->default(null);
            $table->string('status');
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
        Schema::dropIfExists('perkembangans');
    }
}
