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
        Schema::create('course_templates', function (Blueprint $table) {

            $table->id();
            $table->string('course_name');
            $table->integer('grade')->default('13');
            $table->longText('description')->nullable();
            $table->string('subject');
            $table->timestamps();
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
        Schema::dropIfExists('course_templates');
    }
};
