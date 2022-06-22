<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('from_user')->nullable();
            $table->unsignedBigInteger('from_user');
            $table->foreign('from_user')->references('id')->on('users');
            // $table->unsignedBigInteger('to_user')->nullable();
             $table->unsignedBigInteger('to_user');
            $table->foreign('to_user')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorites');
    }
}
