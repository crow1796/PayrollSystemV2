<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->string('id');
            $table->primary('id');
            $table->string('slug')
                    ->default('');
            $table->integer('position_id')
                    ->unsigned();
            $table->foreign('position_id')
                    ->references('id')
                    ->on('positions')
                    ->onDelete('cascade');
            $table->integer('designation_id')
                    ->unsigned();
            $table->foreign('designation_id')
                    ->references('id')
                    ->on('designations')
                    ->onDelete('cascade');
            $table->integer('department_id')
                    ->unsigned();
            $table->foreign('department_id')
                    ->references('id')
                    ->on('departments')
                    ->onDelete('cascade');
            $table->integer('business_unit_id')
                    ->unsigned();
            $table->foreign('business_unit_id')
                    ->references('id')
                    ->on('business_units')
                    ->onDelete('cascade');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('suffix')
                    ->nullable();
            $table->string('email')
                    ->nullable();
            $table->date('date_employed');
            $table->string('street')
                    ->nullable();
            $table->string('city')
                    ->nullable();
            $table->string('province')
                    ->nullable();
            $table->string('zipcode')
                    ->nullable();
            $table->boolean('active')
                    ->default(true);
            $table->softDeletes();
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
        Schema::drop('employees');
    }
}
