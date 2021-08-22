<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');

            $table->string('title', 190)->nullable(false)->comment('商品標題');
            $table->text('description')->nullable()->comment('商品描述');
            $table->enum('category', ['3c', 'food', 'daily_use', 'others'])->comment('商品分類');
            $table->integer('price')->unsigned()->nullable(false)->comment('商品價格');
            $table->string('img', 190)->default('')->comment('商品圖片');

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
        Schema::dropIfExists('product');
    }
}