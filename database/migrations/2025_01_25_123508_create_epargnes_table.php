<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('epargnes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('membre_id')
                  ->constrained('membres', 'id_membre')
                  ->restrictOnDelete();
            $table->decimal('montant', 15, 2);
            $table->enum('type', ['Régulière', 'Projet', 'Retraite']);
            $table->date('date');
            $table->enum('statut', ['actif', 'en_attente', 'termine'])->default('actif');
            $table->decimal('objectif', 15, 2)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('epargnes');
    }
};

