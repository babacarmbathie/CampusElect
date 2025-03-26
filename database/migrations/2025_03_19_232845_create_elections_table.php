<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElectionsTable extends Migration
{
    public function up()
    {
        Schema::create('elections', function (Blueprint $table) {
            $table->id();
            // Ici, le statut est un int, à mapper dans le modèle (ex: 0=CREATED, 1=OPEN, etc.) ou pas
            $table->integer('status');
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('elections');
    }
}
