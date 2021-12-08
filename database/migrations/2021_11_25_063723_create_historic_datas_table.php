<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historic_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('open');
            $table->float('close');
            $table->float('high');
            $table->float('low');
            $table->float('adjusted_close');
            $table->double('volume');
            $table->date('date');
            $table->string('type', '10');
            $table->string('currency', '10');
            $table->foreignId('user_id');
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
        Schema::dropIfExists('historic_datas');
    }
}
