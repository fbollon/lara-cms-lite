<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName;

    /**
     * Run the migrations.
     * @table contents
     *
     * @return void
     */
    public function up()
    {
        $this->tableName = config('lara-cms-lite.table');
        
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('name', 100)
                ->nullable();
            $table->longText('description')
                ->nullable();
            $table->string('route', 100)
                ->nullable()
                ->default(null);
            $table->unsignedBigInteger('creator_id')
                ->nullable();
            $table->boolean('displayed')
                ->nullable();
            
            $table->nullableTimestamps();

            $table->foreign('creator_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}
