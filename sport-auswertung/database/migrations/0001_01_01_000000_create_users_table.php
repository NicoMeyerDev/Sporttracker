<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
    * Legt die Tabelle "activities" an (bei php artisan migrate).
    */
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();                                // Eindeutige Nummer pro Zeile

            // Wird von dir gesetzt (Garmin liefert das nicht zuverlässig)
            $table->string("sport");                     // Sportart, fest und klein: football, cycling, swimming
            $table->string("type");                      // Art der Einheit: Training oder Spiel

            // Pflichtangaben
            $table->dateTime("started_at");              // Beginn mit Datum und Uhrzeit (Garmin liefert UTC)
            $table->integer("distance_m");               // Distanz in Metern

            // Messwerte aus der TCX-Datei, optional (nicht jede Einheit liefert alle)
            $table->integer("duration_s")->nullable();   // Dauer in Sekunden
            $table->float("max_speed_ms")->nullable();   // Höchstgeschwindigkeit in Metern pro Sekunde
            $table->integer("calories")->nullable();     // Verbrannte Kalorien (kcal)
            $table->integer("avg_hr")->nullable();       // Durchschnittspuls in Schlägen pro Minute
            $table->integer("max_hr")->nullable();       // Maximalpuls in Schlägen pro Minute

            $table->timestamps();                        // created_at und updated_at, setzt Laravel selbst
});

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
