<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdditionalInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additional_information', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employee_id');
            $table->foreign('employee_id')
                    ->references('id')
                    ->on('employees')
                    ->onDelete('cascade');
            $table->date('date_of_birth');
            $table->text('place_of_birth');
            $table->float('weight');
            $table->float('height');
            $table->string('religion');
            $table->string('civil_status');
            $table->string('name_of_spouse')
                    ->default('NULL');
            $table->integer('number_of_children')
                    ->default(0);
            $table->string('gender');
            $table->string('educational_attainment');
            $table->string('course');
            $table->string('mother_name');
            $table->string('father_name');
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
        Schema::drop('additional_information');
    }
}
