<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecreateTontineParticipantsTable extends Migration
{
    public function up(): void
    {
        // Supprimer la table existante
        Schema::dropIfExists('tontine_participants');

        // Créer la nouvelle table avec la structure correcte
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

    public function down(): void
    {
        Schema::dropIfExists('tontine_participants');
    }
}
