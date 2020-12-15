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
            $table->string('password');
            $table->integer('role');//訪客-1 窗口-2 學生-3 老師-4 管理員-9
            $table->string('name')->nullable();
            $table->integer('gender')->nullable();

            //教師用
            $table->string('teacherid')->nullable();//教師編號
            $table->integer('school_id')->nullable();
            $table->string('email')->nullable();
            $table->integer('is_verify')->nullable()->default(0);
            $table->text('tutor_classroom_id')->nullable();
            $table->text('subject_classroom_id')->nullable();
            //$table->timestamp('email_verified_at')->nullable();

            //學生用
            $table->integer('cycle_id')->nullable();
            $table->integer('seat_number')->nullable();
            $table->integer('classroom_id')->nullable();//學生班級
            $table->integer('is_local')->nullable();

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
