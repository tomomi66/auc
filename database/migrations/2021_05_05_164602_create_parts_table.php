<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('car_id');
            $table->integer('status')->comment('状態');
            $table->string('parts_name')->comment('パーツ名');
            $table->string('parts_makers')->comment('パーツメーカー')->nullable();
            $table->string('parts_makers_no')->comment('パーツメーカー名')->nullable();
            $table->string('pretitle')->comment('プレタイトル');
            $table->string('condition')->comment('パーツ状態');
            $table->string('operating_status')->comment('動作状態')->nullable();
            $table->integer('check_video')->comment('動作確認動画の有無');
            $table->string('video_url')->comment('ビデオURL')->nullable();
            $table->string('postage_class')->comment('送料区分');
            $table->integer('starting_price')->comment('開始価格');
            $table->integer('pompt_decision')->comment('即決価格')->nullable();
            $table->string('memo')->comment('memo');
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
            $table->string('create_parson')->comment('新規作成者');
            $table->string('chenge_person')->comment('変更者');
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
        Schema::dropIfExists('parts');
    }
}
