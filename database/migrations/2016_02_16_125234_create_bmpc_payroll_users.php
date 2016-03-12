<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBmpcPayrollUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bmpc_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('permission_id')
                    ->unsigned()
                    ->nullable();
            $table->foreign('permission_id')
                    ->references('id')
                    ->on('permissions');
            $table->string('slug')  
                    ->nullable();
            $table->string('username')
                    ->unique();
            $table->foreign('username')
                    ->references('id')
                    ->on('employees')
                    ->onDelete('cascade');
            $table->string('password', 60);
            $table->string('first_name')
                    ->default('');
            $table->string('middle_name')
                    ->default('');
            $table->string('last_name')
                    ->default('');
            $table->string('suffix')
                    ->nullable();
            $table->string('email')
                    ->default('');
            $table->rememberToken();
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
        Schema::drop('bmpc_users');
    }
}
