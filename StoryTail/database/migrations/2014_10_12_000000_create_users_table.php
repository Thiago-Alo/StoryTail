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
            $table->foreignId('account_type_id')->default(2)->constrained();
            $table->string('name');
            $table->string('email')->unique();
            $table->boolean('active')->default(0);
            $table->date('age')->nullable();
            $table->string('slug')->nullable();
            $table->string('photo')->default('')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->timestamp('last_login_at')->nullable();
            $table->string('username')->nullable();
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
