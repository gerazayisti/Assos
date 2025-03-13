<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTontineParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tontine_participants', function (Blueprint $table) {
            // Ajouter la colonne membre_id si elle n'existe pas déjà
            if (!Schema::hasColumn('tontine_participants', 'membre_id')) {
                $table->unsignedBigInteger('membre_id')->nullable();
                
                // Ajouter la contrainte de clé étrangère
                $table->foreign('membre_id')
                      ->references('id_membre')
                      ->on('membres')
                      ->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tontine_participants', function (Blueprint $table) {
            // Supprimer la contrainte de clé étrangère et la colonne si elle existe
            $table->dropForeignIfExists(['membre_id']);
            $table->dropColumnIfExists('membre_id');
        });
    }
}
