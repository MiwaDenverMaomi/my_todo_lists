<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('from_user')->constrained('users');
            $table->unsignedBigInteger('from_user');
            $table->foreign('from_user')->references('id')->on('users');
            // $table->foreignId('to_user')->constrained('users');
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
        Schema::dropIfExists('likes');
    }
}
