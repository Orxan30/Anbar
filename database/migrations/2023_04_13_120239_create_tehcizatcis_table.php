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
        Schema::create('tehcizatcis', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('Tfoto');
            $table->string('firma');
            $table->string('ad');
            $table->string('soyad');
            $table->string('telefon');
            $table->string('email');
            $table->string('unvan');
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
        Schema::dropIfExists('tehcizatcis');
    }
};
