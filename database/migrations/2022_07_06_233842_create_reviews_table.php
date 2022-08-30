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
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->index('user_id');
            $table->index('course_id');
            $table->string('title');
            $table->integer('personality');
            $table->integer('fairness');
            $table->integer('content_coverage');
            $table->integer('difficulty');
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
        Schema::dropIfExists('review_helpfuls');
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('users');
        Schema::enableForeignKeyConstraints();
    }
};
