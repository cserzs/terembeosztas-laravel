<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogs', function (Blueprint $table) {
            $table->unsignedBigInteger('osztaly_id');
            $table->tinyInteger('nap');
            $table->tinyInteger('idopont');
            $table->tinyInteger('pozicio');
            $table->unsignedBigInteger('terem_id');
            $table->timestamps();
            $table->primary(array('osztaly_id', 'nap', 'idopont', 'pozicio'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalogs');
    }
}
