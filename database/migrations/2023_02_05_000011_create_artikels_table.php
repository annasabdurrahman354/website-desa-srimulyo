<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtikelsTable extends Migration
{
    public function up()
    {
        Schema::create('artikels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('rangkuman');
            $table->longText('konten');
            $table->integer('jumlah_pembaca');
            $table->boolean('is_diterbitkan')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
