<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('course_id');
            $table->index('user_id');
            $table->index('course_id');
            $table->string('title');
            $table->integer('personality');
            $table->integer('fairness');
            $table->integer('easiness');
            $table->longText('content');
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('reviewHelpfuls');
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('users');
        Schema::enableForeignKeyConstraints();
    }
};
