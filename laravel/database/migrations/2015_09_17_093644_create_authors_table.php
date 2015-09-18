<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('authors', function(Blueprint $table)
        {
            $table->increments('author_id');
            $table->string('author_name', 100);
            $table->integer('author_type');
            $table->string('author_key', 100);
            $table->string('author_icon', 100);
            $table->string('total_items', 100);
            $table->integer('scan_time')->unsigned()->nullable();
            $table->integer('content_update_time')->unsigned()->nullable();
            $table->integer('total_items_source')->default(0);
            $table->integer('error_cnt')->unsigned()->default(0);
            $table->integer('reach_end')->unsigned()->default(0);
            $table->text('author_extra');
            $table->timestamps();
            /**
            `create_time` int(10) unsigned DEFAULT NULL,
            `update_time` int(10) unsigned DEFAULT NULL,
             */
            $table->unique(['author_type', 'author_key']);
        });

        Schema::create('author_team', function(Blueprint $table)
        {
            $table->integer('author_id')->unsigned()->index();
            $table->integer('team_id')->unsigned()->index();
            $table->integer('user_id')->unsigned();
            $table->unique(['author_id','team_id']);
            $table->timestamps();

            $table->foreign("author_id")->references('author_id')->on("authors")->onDelete('cascade');
            $table->foreign("team_id")->references('team_id')->on("teams")->onDelete('cascade');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('author_team', function (Blueprint $table){
            $table->dropForeign(["author_id"]);
            $table->dropForeign(["team_id"]);
        });


        Schema::drop("authors");
        Schema::drop("author_team");
    }
}
