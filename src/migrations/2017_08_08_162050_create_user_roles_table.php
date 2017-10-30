<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->engine = "innoDB";
            
            $table->increments('id');
            $table->integer('users_id')->unsigned();
            $table->integer('role_names_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('users_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

            $table->foreign('role_names_id')
                  ->references('id')->on('role_names')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_roles');
    }
}
