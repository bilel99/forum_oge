<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionReponseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_reponse', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('id_question_forum')->unsigned()->nullable();
            $table->integer('id_users')->unsigned()->nullable();
            $table->text('description');
            $table->timestamps();

            $table->foreign('id_question_forum')->references('id')->on('question_forum');
            $table->foreign('id_users')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('question_reponse');
    }
}
