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
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->decimal('price', 4, 2)->unsigned();
            $table->string('photo', 200)->nullable();
            $table->unsignedBigInteger('restorant_id');
            $table->foreign('restorant_id')->references('id')->on('restorants');
            $table->text('rating_json')->nullable();
            $table->decimal('rating', 4, 2)->unsigned()->default(0);
            $table->decimal('counts', 4, 0)->unsigned()->default(0);
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
        Schema::dropIfExists('dishes');
    }
};
