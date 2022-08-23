<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('events', function (Blueprint $table) {
            $table->integer('cod_evento')->primary();
            $table->string('nome_evento',50);
            $table->string('descrizione',50);
            $table->dateTime('data');
            $table->string('regione',30);
            $table->float('prezzo_biglietto');
            $table->integer('n_biglietti');
            $table->integer('n_b_venduti');
            $table->string('programma',2000);
            $table->string('organizzatore')->index();
            $table->string('luogo',30);
            $table->integer('partecipazioni');

             });
            Schema::table('events', function (Blueprint $table) {
            $table->foreign('organizzatore')->references('nome_utente')->on('users');
            });

      }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evento');
    }
}
