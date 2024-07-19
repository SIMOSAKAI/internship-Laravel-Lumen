<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entite', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
        });
        DB::insert('insert into entite (nom) values (?), (?), (?), (?), (?), (?), (?)',[
            'Prestations de proximité',
            'Information et Communication',
            'Ressources financières et Systèmes d\'information',
            'Promotion et Développement',
            'Formation et Networking',
            'Partenariat et Diplomatie',
            'Stratégie et Relations institutionnelles',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entite');
    }
};
