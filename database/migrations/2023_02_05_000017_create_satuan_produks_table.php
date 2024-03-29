<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSatuanProduksTable extends Migration
{
    public function up()
    {
        Schema::create('satuan_produks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('satuan')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
