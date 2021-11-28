<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCityHallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_halls', function (Blueprint $table) {
            $table->id();
            $table->string('razao_social');
            $table->bigInteger('id_city');
            $table->string('city');
            $table->string('estado');
            $table->string('address')->nullable();
            $table->string('number')->nullable();
            $table->string('district')->nullable();
            $table->integer('status')->default(1)->comment('1 - Em análise,  2 - Ganha 3 - Não Ganha');
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
        Schema::dropIfExists('city_halls');
    }
}
