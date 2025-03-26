<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            // Référence à l'élection à laquelle appartient le candidat
            $table->foreignId('election_id')->constrained('elections')->onDelete('cascade');
            $table->string('name');
            $table->text('program');
            $table->string('photo_path')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('candidates');
    }
}
