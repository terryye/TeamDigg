<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('team_id');
            $table->string('team_name', 60);
            $table->string('team_intro');
            $table->timestamps();

        });

        Schema::create('team_user', function(Blueprint $table)
        {
            $table->integer('user_id')->unsigned()->index();
            $table->integer('user_role')->unsigned();
            $table->integer('team_id')->unsigned()->index();
            $table->timestamps();
            $table->unique(['user_id', 'team_id']);

            $table->foreign('team_id')->references('team_id')->on('teams')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');


        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('team_user', function (Blueprint $table) {
            $table->dropForeign(['team_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::drop("teams");//
        Schema::drop("team_user");
    }
}
