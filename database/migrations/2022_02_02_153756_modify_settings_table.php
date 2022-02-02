<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifySettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('price_cut_negoti')->comment('発送市区町村')->change();
            $table->renameColumn('price_cut_negoti', 'from_city');
            $table->text('comment1')->change();
            $table->text('comment2')->change();
            $table->text('comment3')->change();
            $table->dropColumn('featured_action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('from_city')->comment('値下げ交渉')->change();
            $table->renameColumn('from_city', 'price_cut_negoti');
            $table->string('comment1')->change();
            $table->string('comment2')->change();
            $table->string('comment3')->change();
            $table->string('featured_action')->comment('注目のオークション');
        });
    }
}
