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
        // Add new table for page blocks
        Schema::create('page_blocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('page_id');
            $table->enum('type', ['template', 'include'])->default('include');
            $table->string('path');
            $table->mediumText('data');
            $table->boolean('is_hidden')->default(false);
            $table->boolean('is_minimized')->default(false);
            $table->boolean('is_delete_denied')->default(false);
            $table->integer('cache_ttl')->default(0);
            $table->integer('order')->default(10000);

            $table->index('page_id');

            $table->timestamps();
        });

        // Add Page layout column
        Schema::table('pages', function (Blueprint $table) {
            $table->text('layout')->nullable();
        });

        // If we take this approach, we'll need to also remove the respective row from data_rows.
        // -- We can then delete resources/views/vendor/voyager/pages/edit-add.blade.php
        //
        // Remove the body attribute
        // Schema::table('pages', function (Blueprint $table) {
        //     $table->dropColumn('body');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remove Page Blocks table
        Schema::dropIfExists('page_blocks');

        // Remove Page layout column
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('layout');
        });

        // Add the body attribute back
        // Schema::table('pages', function (Blueprint $table) {
        //     $table->text('body')->nullable();
        // });
    }
}
