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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('super_admin')->default(0);
            $table->integer('user_admin')->default(0);
            $table->integer('admin_block')->default(1);
            $table->string('Ufoto')->default('storage/app/public/uploads/users/nofoto.jpg');
            $table->string('ad');
            $table->string('soyad');
            $table->string('telefon');
            $table->text('menyu')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
