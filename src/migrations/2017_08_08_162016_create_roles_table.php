<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->engine = "innoDB";
            $table->increments('id');
            $table->integer('role_names_id')->unsigned();
            $table->integer('routes_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('role_names_id')
                  ->references('id')->on('role_names')
                  ->onDelete('cascade');

            $table->foreign('routes_id')
                  ->references('id')->on('routes')
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
        Schema::dropIfExists('roles');
    }
}
