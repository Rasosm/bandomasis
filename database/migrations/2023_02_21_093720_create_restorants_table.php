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
        Schema::create('restorants', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('town', 100);
            $table->string('address', 200);
            $table->time('start')->nullable();;
            $table->time('end')->nullable();;
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
        Schema::dropIfExists('restorants');
    }
};
