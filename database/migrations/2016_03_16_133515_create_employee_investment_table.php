<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeInvestmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_investment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employee_id');
            $table->foreign('employee_id')
                    ->references('id')
                    ->on('employees')
                    ->onDelete('cascade');
            $table->integer('investment_id');
            $table->foreign('investment_id')
                    ->references('id')
                    ->on('investments')
                    ->onDelete('cascade');
            $table->float('deduction')
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
        Schema::drop('employee_investment');
    }
}
