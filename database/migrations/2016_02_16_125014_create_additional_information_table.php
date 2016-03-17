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
            $table->date('date_of_birth')
                    ->nullable();
            $table->text('place_of_birth')
                    ->nullable();
            $table->float('weight')
                    ->nullable();
            $table->float('height')
                    ->nullable();
            $table->string('religion')
                    ->nullable();
            $table->string('civil_status')
                    ->nullable();
            $table->string('name_of_spouse')
                    ->nullable();
            $table->integer('number_of_children')
                    ->nullable();
            $table->string('gender')
                    ->nullable();
            $table->string('educational_attainment')
                    ->nullable();
            $table->string('course')
                    ->nullable();
            $table->string('mother_name')
                    ->nullable();
            $table->string('father_name')
                    ->nullable();
            $table->text('display_photo')
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
        Schema::drop('additional_information');
    }
}
