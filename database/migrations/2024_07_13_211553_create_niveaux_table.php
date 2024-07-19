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
        Schema::create('niveaux', function (Blueprint $table) {
            $table->id();
            $table->string('niveau', 255);
        });

        DB::insert('insert into niveaux (niveau) values (?), (?), (?), (?), (?), (?)',[
            'niveau bac',
            'bac+1',
            'bac+2',
            'bac+3',
            'bac+4',
            'bac+5',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('niveaux');
    }
};
