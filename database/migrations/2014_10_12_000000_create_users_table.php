<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->string('name');
            $table->bigInteger('nik')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('cabang');
            $table->string('avatar')->nullable();
            $table->enum('role', array('Admin', 'User'));
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(array('name'=>'admin', 'nik' => 3204082311900001, 'email'=>'admin@gmail.com', 'avatar' => '', 'Cabang' => 'Jawa Barat', 'role' => 'Admin', 'password'=>Hash::make('password')));
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
}
