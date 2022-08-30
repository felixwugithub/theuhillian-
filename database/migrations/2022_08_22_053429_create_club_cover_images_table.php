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
        Schema::create('club_cover_images', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('club_id')->constrained()->cascadeOnDelete();
            $table->string('image');
            $table->index('club_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('club_cover_images');
    }
};
