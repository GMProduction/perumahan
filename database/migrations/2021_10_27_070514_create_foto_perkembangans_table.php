<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotoPerkembangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foto_perkembangans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('perkembangan_id')->unsigned()->nullable(true);
            $table->foreign('perkembangan_id')->references('id')->on('perkembangans');
            $table->text('image');
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
        Schema::dropIfExists('foto_perkembangans');
    }
}
