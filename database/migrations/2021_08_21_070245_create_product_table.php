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
            $table->enum('category', ['3c', 'food', 'daily_use', 'cup', 'fitting', 'furniture', 'others'])->comment('商品分類');
            $table->integer('price')->unsigned()->nullable(false)->comment('商品價格');
            $table->string('img', 190)->default('')->comment('商品圖片');
            $table->integer('total')->default(0)->comment('商品數量');

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
        Schema::dropIfExists('product');
    }
}
