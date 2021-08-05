<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('program_id');
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
            $table->unsignedBigInteger('categories_id');
            $table->foreign('categories_id')->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedBigInteger('strategies_id');
            $table->foreign('strategies_id')->references('id')->on('strategies')->onDelete('cascade');
            $table->string('name');
            $table->text('description');
            $table->integer('done');
            $table->string('dead_line');
            $table->string('delivery');
            $table->integer('user_id')->default(0);
            $table->integer('manager_id')->default(0);
            $table->integer('admin_id')->default(0);
            $table->text('obst');
            $table->integer('repeat');
            $table->integer('repeat_count')->default(0);
            $table->integer('repeat_done')->default(0);
            $table->integer('plan_id')->default(1);
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
        Schema::dropIfExists('actions');
    }
}
