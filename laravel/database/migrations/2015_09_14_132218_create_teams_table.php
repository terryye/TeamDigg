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
            $table->integer('user_type')->unsigned();
            $table->integer('team_id')->unsigned()->index();
            $table->timestamps();
            $table->unique(['user_id', 'team_id']);
        });

        //create foreign key constrain
        Schema::table('teams', function (Blueprint $table) {
            $table->foreign('team_id','teams_2_users')->references('team_id')->on('team_user')->onDelete('cascade');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('id','users_2_teams')->references('user_id')->on('team_user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropForeign('teams_2_users');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_2_teams');
        });


        Schema::drop("teams");//
        Schema::drop("team_user");
    }
}
