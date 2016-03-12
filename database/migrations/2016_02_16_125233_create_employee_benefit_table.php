<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeBenefitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_benefit', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employee_id');
            $table->foreign('employee_id')
                    ->references('id')
                    ->on('employees')
                    ->onDelete('cascade');
            $table->integer('benefit_id')
                    ->unsigned();
            $table->foreign('benefit_id')
                    ->references('id')
                    ->on('benefits')
                    ->onDelete('cascade');
            $table->string('benefit_id_value')
                    ->nullable();
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
        Schema::drop('employee_benefit');
    }
}
