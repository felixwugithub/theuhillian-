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
        Schema::create('course_requests', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('code')->nullable();
            $table->string('description');
            $table->string('teacher_name');
            $table->string('room_number')->nullable();
            $table->integer('grade');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->boolean('accepted')->default(false);
            $table->boolean('closed')->default(false);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_requests');
    }
};
