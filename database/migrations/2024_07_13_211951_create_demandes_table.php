<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->date('dateDemande');
            $table->date('dateDebut');
            $table->date('dateFin');
            $table->string('objet');
            $table->longText('detail');
            $table->unsignedBigInteger('idEntite');
            $table->unsignedBigInteger('idStatut');
            $table->unsignedBigInteger('idStagiaire');

            $table->foreign('idStatut')->references('id')->on('statuts');
            $table->foreign('idEntite')->references('id')->on('entite');
            $table->foreign('idStagiaire')->references('id')->on('stagiaires');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demandes');
    }
};
