<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PgEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pg_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('events');
            $table->integer('departments');
            $table->text('description');
            $table->string('except');
            $table->DateTime('eventStart');
            $table->DateTime('eventEnd');
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
       Schema::dropIfExists('pg_events');
    }
}
