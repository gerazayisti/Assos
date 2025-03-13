<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class EnsureTontineParticipantsStructure extends Migration
{
    public function up(): void
    {
        // Supprimer la table existante si nécessaire
        Schema::dropIfExists('tontine_participants');

        // Créer la table avec la structure correcte
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

        // Migrer les données existantes si nécessaire
        $this->migrateExistingData();
    }

    public function down(): void
    {
        Schema::dropIfExists('tontine_participants');
    }

    private function migrateExistingData(): void
    {
        // Si vous avez des données existantes à migrer, ajoutez la logique ici
        // Par exemple, copier les données d'une ancienne table vers la nouvelle
    }
}
