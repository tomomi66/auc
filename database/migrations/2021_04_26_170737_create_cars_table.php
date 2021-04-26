<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->integer('in_number')->index('入庫番号');
            $table->integer('status')->index('状態');
            $table->integer('registration_volume')->index('登録パーツ数');
            $table->string('made_date')->index('年式');
            $table->string('model_type')->index('型式');
            $table->string('model_grade')->index('グレード');
            $table->string('color')->index('色');
            $table->integer('color_no')->index('カラーNo');
            $table->integer('trim_no')->index('トリムナンバー');
            $table->integer('mileage')->index('走行距離');
            $table->string('create_parson')->index('新規作成者');
            $table->string('chenge_person')->index('変更者');
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
