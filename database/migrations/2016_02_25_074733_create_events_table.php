<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')
                    ->default('');
            $table->integer('event_type_id')
                    ->unsigned();
            $table->foreign('event_type_id')
                    ->references('id')
                    ->on('event_types')
                    ->onDelete('cascade');
            $table->boolean('allDay')
                    ->nullable();
            $table->timestamp('start');
            $table->timestamp('end')
                    ->nullable();
            $table->text('description')
                    ->nullable();
            $table->text('location')
                    ->nullable();
            $table->string('className')
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
        Schema::drop('events');
    }
}
