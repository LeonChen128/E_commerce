<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();

            $table->string('name', 190)->comment('使用者名稱');
            $table->string('account', 190)->unique()->comment('使用者帳號');
            $table->string('password', 190)->comment('使用者密碼');
            $table->string('address', 190)->comment('使用者地址');
            $table->string('phone', 50)->comment('使用者電話');
            $table->rememberToken();

            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
