<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('membres', function (Blueprint $table) {
            $table->id('id_membre');
            $table->string('nom', 100);
            $table->string('prenom', 100);
            $table->date('date_naissance')->nullable();
            $table->string('lieu_naissance', 100)->nullable();
            $table->enum('sexe', ['M', 'F']);
            $table->string('telephone', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->text('adresse')->nullable();
            $table->string('profession', 100)->nullable();
            $table->timestamp('date_adhesion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->enum('statut', ['actif', 'inactif', 'suspendu'])->default('actif');
            $table->string('photo_path', 255)->nullable();
            $table->enum('role', ['membre', 'admin', 'tresorier', 'secretaire', 'president'])->default('membre');
            $table->string('numero_membre', 20)->unique();
            $table->datetime('derniere_connexion')->nullable();
            $table->string('mot_de_passe', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('membres');
    }
};
