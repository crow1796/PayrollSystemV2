<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rateable_id');
            $table->string('rateable_type');

            $table->float('regular');
            $table->float('ot_regular');
            $table->float('nd_regular');
            $table->float('nd_ot_regular');

            $table->float('sun');
            $table->float('sun_ot');
            $table->float('sun_nd');
            $table->float('sun_nd_ot');

            $table->float('sp_holiday');
            $table->float('sp_holiday_ot');
            $table->float('sp_holiday_nd');
            $table->float('sp_holiday_nd_ot');

            $table->float('legal_holiday');
            $table->float('legal_holiday_ot');
            $table->float('legal_holiday_nd');
            $table->float('legal_holiday_nd_ot');

            $table->float('legal_sun');
            $table->float('legal_sun_ot');
            $table->float('legal_sun_nd');
            $table->float('legal_sun_nd_ot');

            $table->float('no_work_legal_holiday');
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
        Schema::drop('rates');
    }
}
