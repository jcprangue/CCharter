<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChartersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('service_name');
            $table->text('steps');
            $table->text('requirements');
            $table->string('forms_used');
            $table->string('processing_time');
            $table->string('service_provider');
            $table->integer('dept');
            $table->integer('service_code');

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
        Schema::dropIfExists('charters');
    }
}
