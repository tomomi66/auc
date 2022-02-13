<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class AddFinishsColumnPartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parts', function (Blueprint $table) {
            $table->string('finish_day')->comment('終了日')->nullable();
            $table->string('finish_hour')->comment('終了時間帯')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parts', function (Blueprint $table) {
            $table->dropColumn('finish_day');
            $table->dropColumn('finish_hour');
        });
    }
}
