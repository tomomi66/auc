<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PhpParser\Comment;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('in_number')->comment('入庫番号');
            $table->integer('status')->comment('状態');
            $table->integer('registration_volume')->comment('登録パーツ数');
            $table->string('made_date')->comment('年式');
            $table->string('model_type')->comment('型式');
            $table->string('model_grade')->comment('グレード');
            $table->string('color')->comment('色');
            $table->integer('color_no')->comment('カラーNo');
            $table->integer('trim_no')->comment('トリムナンバー');
            $table->integer('mileage')->comment('走行距離');
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
        Schema::dropIfExists('cars');
    }
}
