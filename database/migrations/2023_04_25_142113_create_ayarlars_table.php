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
        Schema::create('ayarlars', function (Blueprint $table) {
            $table->id();
            $table->string('Logo')->default('storage/app/public/uploads/ayarlar/LOGO.jpg');
            $table->string('sirket')->default('Stock Laravel');
            $table->string('mail')->default('xxx@gmail.com');
            $table->string('tel')->default('050-xxx-xx-xx');
            $table->string('unvan')->default('Suleyman Rahimov');
            $table->string('footer')->default('© 2023, Programming by : Orkhan Panahli');
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
        Schema::dropIfExists('ayarlars');
    }
};
