<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnRecordNumberOnCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->string('record_number')->comment('カルテ番号');
            $table->string('gear_shift')->comment('シフト')->nullable();
            $table->integer('made_year')->comment('年式-年');
            $table->integer('made_month')->comment('年式-月');

            $table->dropColumn('registration_volume');
            $table->dropColumn('made_date');
            $table->dropColumn('in_number');

            $table->string('model_grade')->nullable()->change();
            $table->string('color')->nullable()->change();
            $table->string('color_no')->nullable()->change();
            $table->string('trim_no')->nullable()->change();
            $table->integer('mileage')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn('record_number');
            $table->dropColumn('gear_shift');
            $table->dropColumn('made_year');
            $table->dropColumn('made_month');
            $table->integer('registration_volume')->comment('登録パーツ数');
            $table->string('made_date')->comment('年式');
        });
    }
}
