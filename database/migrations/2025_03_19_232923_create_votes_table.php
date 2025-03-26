<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotesTable extends Migration
{
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            // Références aux autres tables
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('election_id')->constrained('elections')->onDelete('cascade');
            $table->foreignId('candidate_id')->constrained('candidates')->onDelete('cascade');
            $table->timestamp('created_at')->useCurrent();
         });
    }

    public function down()
    {
        Schema::dropIfExists('votes');
    }
}
