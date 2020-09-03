<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpicAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('epic_accounts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('name')->unique()->nullable();
            $table->string('solo_victory')->nullable();
            $table->string('solo_matches')->nullable();
            $table->string('solo_kills')->nullable();
            $table->string('duo_victory')->nullable();
            $table->string('duo_matches')->nullable();
            $table->string('duo_kills')->nullable();
            $table->string('squad_victory')->nullable();
            $table->string('squad_matches')->nullable();
            $table->string('squad_kills')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('epic_accounts');
    }
}
