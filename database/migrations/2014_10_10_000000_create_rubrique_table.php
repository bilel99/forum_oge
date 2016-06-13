<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRubriqueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rubrique', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('nom', 255);
            $table->text('description');
            $table->enum('statut', array('Actif', 'Archivé'));
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
        Schema::drop('rubrique');
    }
}
