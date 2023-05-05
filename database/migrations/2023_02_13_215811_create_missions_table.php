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
        Schema::create('missions', function (Blueprint $table) {
            $table->id();
            $table->string('parola_cruciverba')->nullable();
            $table->string('selfie_sposa')->nullable();
            $table->string('selfie_sposo')->nullable();
            $table->boolean('brindisi')->default(false);
            $table->string('video_brindisi')->nullable();
            $table->string('parola_jenga')->nullable();
            $table->integer('punteggio')->default(0);
            $table->string('indovinello')->nullable();
            $table->dateTime('date');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('missions');
    }
};
