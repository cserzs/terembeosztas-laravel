<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolclassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schoolclasses', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('evfolyam');
            $table->string('betujel', 2);
            $table->string('nev', 30);
            $table->string('rovid_nev', 10);
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
        Schema::dropIfExists('schoolclasses');
    }
}
