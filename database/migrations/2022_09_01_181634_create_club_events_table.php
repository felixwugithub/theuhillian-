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
        Schema::create('club_events', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->default('Club Event');
            $table->longText('description')->nullable();
            $table->foreignId('club_id');
            $table->index('club_id');

            $table->string('location');
            $table->string('url')->nullable();

            $table->dateTime('start_time');
            $table->dateTime('end_time')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('club_events');
    }
};
