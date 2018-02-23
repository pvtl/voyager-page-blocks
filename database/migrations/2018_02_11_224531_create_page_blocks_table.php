<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_blocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('page_id');
            $table->enum('type', ['template', 'include'])->default('include');
            $table->string('filepath');
            $table->mediumText('data');
            $table->boolean('is_hidden')->default(false);
            $table->boolean('is_minimized')->default(false);
            $table->boolean('is_delete_denied')->default(false);
            $table->integer('cache_ttl')->default(0);
            $table->integer('order')->default(10000);

            $table->index('page_id');

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
        Schema::dropIfExists('page_blocks');
    }
}
