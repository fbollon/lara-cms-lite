<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDisplayFieldsToContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->tableName = config('lara-cms-lite.table');
        
        Schema::table($this->tableName, function (Blueprint $table) {
            $table->boolean('display_title')
                ->nullable();
            $table->boolean('display_footer')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table($this->tableName, function (Blueprint $table) {
            $table->dropColumn(['display_title', 'display_footer']);
        });
    }
}
