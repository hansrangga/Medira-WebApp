<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekam__medis', function (Blueprint $table) {
            $table->id();
            $table->integer('idpasien');
            $table->string('pemeriksa');
            $table->text('gejala');
            $table->text('anamnesis');
            $table->text('pfisik');
            $table->text('lab');
            $table->text('hasil');
            $table->string('diagnosis');
            $table->text('resep');
            $table->text('jumlah');
            $table->text('aturan');
            $table->tinyInteger('deleted')->default(0);
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
        Schema::dropIfExists('rekam__medis');
    }
};
