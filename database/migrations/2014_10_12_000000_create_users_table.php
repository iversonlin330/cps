<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->string('account')->unique();
            $table->string('name')->nullable();
            $table->integer('gender')->nullable();
            $table->string('teacherid')->nullable();
            $table->integer('school_id')->nullable();
            $table->string('email')->nullable();
            //$table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('classroom_id')->nullable();
            $table->integer('role');//訪客-1 窗口-2 學生-3 老師-4 管理員-9

            $table->integer('cycle_id')->nullable();
            $table->integer('seat_number')->nullable();
            $table->integer('is_local')->nullable();
            $table->integer('is_verify')->nullable();

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
}
