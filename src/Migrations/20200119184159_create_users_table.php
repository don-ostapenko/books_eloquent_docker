<?php

use App\Services\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->schema->create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nickname', 128);
            $table->string('email', 255);
            $table->integer('role');
            $table->string('password_hash', 255);
            $table->string('auth_token', 255);
            $table->dateTime('created_at');
        });
    }

    public function down()
    {
        $this->schema->dropIfExists('users');
    }
}