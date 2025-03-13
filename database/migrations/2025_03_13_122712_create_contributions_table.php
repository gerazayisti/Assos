<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContributionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contributions');
    }
}
