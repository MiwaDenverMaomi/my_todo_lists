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
            $table->unsignedBigInteger('from_user');
            $table->foreign('from_user')->references('id')->on('users')->cascadeOnDelete();
            $table->unsignedBigInteger('to_user');
            $table->foreign('to_user')->references('id')->on('users')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['from_user','to_user']);
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
