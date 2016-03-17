<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employee_id');
            $table->foreign('employee_id')
                    ->references('id')
                    ->on('employees')
                    ->onDelete('cascade');
            $table->integer('expenses_id');
            $table->foreign('expenses_id')
                    ->references('id')
                    ->on('expenses')
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
        Schema::drop('employee_expenses');
    }
}
