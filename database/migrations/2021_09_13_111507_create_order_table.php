<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');

            $table->string('no', 50)->comment('訂單編號(頭)');
            $table->tinyInteger('hash')->unsigned()->comment('訂單編號(尾)');
            $table->integer('price')->unsigned()->comment('訂單價錢');
            $table->enum('status', ['wait', 'ing', 'cancel', 'finish'])->default('wait')->comment('狀態');

            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();

            $table->index(['user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
