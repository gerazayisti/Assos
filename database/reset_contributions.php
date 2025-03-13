<?php

require __DIR__ . '/../vendor/autoload.php';

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Supprimer la table existante
Schema::dropIfExists('contributions');

// Créer la nouvelle table
Schema::create('contributions', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('tontine_id');
    $table->unsignedBigInteger('membre_id');
    $table->decimal('amount', 10, 2);
    $table->date('contribution_date');
    $table->text('description')->nullable();
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
});

echo "Table contributions recréée avec succès.\n";
