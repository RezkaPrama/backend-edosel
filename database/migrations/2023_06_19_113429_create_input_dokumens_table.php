<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInputDokumensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('input_dokumens', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nik');
            $table->char('no_dosir', 30);
            $table->string('nama');
            $table->date('tanggal_input');
            $table->string('pangkat');
            $table->string('satuan');
            $table->string('personel');
            $table->bigInteger('shelf_id')->unsigned();
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
        Schema::dropIfExists('input_dokumens');
    }
}
