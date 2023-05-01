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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_utente')->unsigned();
            $table->string('parola_cruciverba')->nullable();
            $table->string('selfie_sposa')->nullable();
            $table->string('selfie_sposo')->nullable();
            $table->boolean('brindisi')->default(false);
            $table->string('video_brindisi')->nullable();
            $table->string('parola_jenga ')->nullable();
            $table->integer('punteggio')->default(0);
            $table->string('indovinello')->nullable();
            $table->dateTime('date');
        });

        Schema::table('users', function ($table) {
            $table->foreign('id_utente')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
