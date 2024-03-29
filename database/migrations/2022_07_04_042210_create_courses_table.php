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
            $table->foreignId('teacher_id')->constrained()->cascadeOnDelete();
            $table->string('subject');
            $table->integer('grade')->default('13');
            $table->double('personality')->default('5');
            $table->double('content_coverage')->default('5');
            $table->double('fairness')->default('5');
            $table->double('difficulty')->default('5');
            $table->double('overall')->default('5');
            $table->integer('review_count')->default('0');
            $table->timestamp('date_added')->nullable();
            $table->longText('description')->nullable();
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->index('teacher_id');
            $table->string('code')->nullable();

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
