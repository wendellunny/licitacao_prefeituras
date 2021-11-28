<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('description')->nullable();
            $table->integer('type')->comment('1 - Ligações 2 - Visitas');
            $table->integer('status')->comment('1 - Agendadada, 2 - Adiada , 3 - Concluída, 4 - Cancelada');
            $table->dateTime('scheduled_date');
            $table->dateTime('postponed date')->nullable();
            
            $table->foreignId('city_hall_id');
            $table->foreign('city_hall_id')->references('id')->on('city_halls');
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
        Schema::dropIfExists('activities');
    }
}
