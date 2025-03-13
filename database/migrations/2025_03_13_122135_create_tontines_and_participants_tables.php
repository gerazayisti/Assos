<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTontinesAndParticipantsTables extends Migration
{
    public function up()
    {
        Schema::create('tontines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['petite', 'grande']);
            $table->decimal('amount_per_person', 10, 2);
            $table->integer('total_participants');
            $table->integer('current_participants')->default(0);
            $table->date('start_date');
            $table->enum('status', ['en_cours', 'terminee', 'annulee'])->default('en_cours');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('tontine_participants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tontine_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('tontine_id')->references('id')->on('tontines')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tontine_participants');
        Schema::dropIfExists('tontines');
    }
}
