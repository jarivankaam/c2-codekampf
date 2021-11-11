<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PageLikes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->nullable(true);
            $table->foreign("user_id")->references("id")->on("users")->cascadeOnDelete();
            $table->foreignId("page_id");
            $table->foreign("page_id")->references("id")->on("page")->cascadeOnDelete();
            $table->string("session_id")->nullable(true);
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
        Schema::dropIfExists('page_likes');
    }
}
