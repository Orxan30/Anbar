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
        Schema::create('seneds', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('staff_id');
            $table->string('Sndfoto');
            $table->string('cod');
            $table->string('ad');
            $table->string('metn');
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
        Schema::dropIfExists('seneds');
    }
};
