<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('strategy');
            $table->string('category');
            $table->integer('row');
            $table->string('name');
            $table->string('dead_line');
            $table->text('description');
            $table->text('rcancel');
            $table->text('shortcut');
            $table->unsignedBigInteger('strategies_id');
            $table->foreign('strategies_id')->references('id')->on('strategies')->onDelete('cascade');
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
        Schema::dropIfExists('programs');
    }
}
