<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayrolltransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolltransactions', function (Blueprint $table) {
            $table->increments('id');
            $table->date('cutoff_start');
            $table->date('cutoff_end');
            $table->string('cutoff');
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
        Schema::drop('payrolltransactions');
    }
}
