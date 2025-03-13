<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTontinesParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tontine_participants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tontine_id');
            $table->unsignedBigInteger('membre_id');
            $table->timestamps();

            // Contraintes de clé étrangère
            $table->foreign('tontine_id')
                  ->references('id')
                  ->on('tontines')
                  ->onDelete('cascade');

            $table->foreign('membre_id')
                  ->references('id_membre')
                  ->on('membres')
                  ->onDelete('cascade');

            // Contrainte d'unicité pour éviter les doublons
            $table->unique(['tontine_id', 'membre_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tontine_participants');
    }
}
