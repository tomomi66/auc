<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('parts_id')->comment('パーツID');
            $table->integer('category')->comment('カテゴリ');
            $table->string('title')->comment('タイトル');
            $table->text('descript')->comment('商品説明');
            $table->string('keyword')->comment('オークションキーワード')->nullable();
            $table->integer('starting_price')->comment('開始価格');
            $table->integer('pompt_decision')->comment('即決価格')->nullable();
            $table->integer('term')->comment('期間');
            $table->integer('end_time')->comment('終了時間')->nullable();
            $table->integer('shipping_group')->comment('配送グループ');
            $table->text('condition')->comment('商品の状態');
            $table->string('image1')->comment('画像1');
            $table->string('image1_caption')->comment('画像1キャプション')->nullable();
            $table->string('image2')->comment('画像2')->nullable();
            $table->string('image2_caption')->comment('画像2キャプション')->nullable();
            $table->string('image3')->comment('画像3')->nullable();
            $table->string('image3_caption')->comment('画像3キャプション')->nullable();
            $table->string('image4')->comment('画像4')->nullable();
            $table->string('image4_caption')->comment('画像4キャプション')->nullable();
            $table->string('image5')->comment('画像5')->nullable();
            $table->string('image5_caption')->comment('画像5キャプション')->nullable();
            $table->string('image6')->comment('画像6')->nullable();
            $table->string('image6_caption')->comment('画像6キャプション')->nullable();
            $table->string('image7')->comment('画像7')->nullable();
            $table->string('image7_caption')->comment('画像7キャプション')->nullable();
            $table->string('image8')->comment('画像8')->nullable();
            $table->string('image8_caption')->comment('画像8キャプション')->nullable();
            $table->string('image9')->comment('画像9')->nullable();
            $table->string('image9_caption')->comment('画像9キャプション')->nullable();
            $table->string('image10')->comment('画像10')->nullable();
            $table->string('image10_caption')->comment('画像10キャプション')->nullable();
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
        Schema::dropIfExists('auctions');
    }
}
