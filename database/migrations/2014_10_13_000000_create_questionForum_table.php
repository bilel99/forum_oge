<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionForumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_forum', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('id_rubrique')->unsigned()->nullable();
            $table->integer('id_users')->unsigned()->nullable();
            $table->string('nom', 50);
            $table->text('description');
            $table->enum('statut', array('Actif', 'Archivé'));
            $table->integer('valider')->unsigned();
            $table->timestamps();

            $table->foreign('id_rubrique')->references('id')->on('rubrique');
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
        Schema::drop('question_forum');
    }
}
