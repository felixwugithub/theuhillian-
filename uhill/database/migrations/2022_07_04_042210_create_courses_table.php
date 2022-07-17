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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_name');
            $table->unsignedBigInteger('teacher_id');
            $table->integer('personality');
            $table->integer('fairness');
            $table->integer('easiness');
            $table->integer('overall')->default('1');
            $table->integer('review_count')->default('0');
            $table->timestamp('date_added');
            $table->longText('description');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->index('teacher_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
};
