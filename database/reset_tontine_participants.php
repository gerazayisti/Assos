<?php

require __DIR__ . '/../vendor/autoload.php';

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Supprimer la table existante
Schema::dropIfExists('tontine_participants');

// Créer la nouvelle table
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

echo "Table tontine_participants recréée avec succès.\n";
