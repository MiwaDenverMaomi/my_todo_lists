<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_tokens', function (Blueprint $table) {
            $table->id()->comment('ID');
            $table->foreignId('user_id')->constrained()->comment('id for user');
            $table->string('token')->unique()->comment('token');
            $table->dateTime('expire_at')->nullable()->comment('experation data for token');
            $table->timestamps();
        });
        //   DB::statement("alter table user_tokens comment 'user token'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_tokens');
    }
}
