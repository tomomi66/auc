<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyPartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parts', function (Blueprint $table) {
            $table->text('memo')->change();
            $table->string('pretitle')->comment('タイトル')->change();
            $table->renameColumn('pretitle', 'title');
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
            $table->string('memo')->change();
            $table->string('title')->comment('プレタイトル')->change();
            $table->renameColumn('title', 'pretitle');
        });
    }
}
