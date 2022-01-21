<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('comment1')->comment('詳細テンプレ1上部');
            $table->string('comment2')->comment('詳細テンプレ2真ん中');
            $table->string('comment3')->comment('詳細テンプレ3下段');
            $table->string('from_prefecture')->comment('発送元');
            $table->string('fee_burden')->comment('送料負担');
            $table->string('pay_method')->comment('支払方法(後払い先払い）');
            $table->string('min_rate')->comment('最低評価');
            $table->string('evil_rate_limit')->comment('悪評価割合制限');
            $table->string('authen_limit')->comment('入札者認証制限');
            $table->string('auto_extend')->comment('自動延長');
            $table->string('price_cut_negoti')->comment('値下げ交渉');
            $table->string('auto_listing')->comment('商品の自動再出品');
            $table->string('featured_action')->comment('注目のオークション');
            $table->string('tax_preference')->comment('消費税設定');
            $table->boolean('in_tax_setting_flg')->comment('税込み設定フラグ');
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
        Schema::dropIfExists('settings');
    }
}
