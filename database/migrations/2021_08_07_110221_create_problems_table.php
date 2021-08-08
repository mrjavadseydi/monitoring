<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problems', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('actions_id');
            $table->foreign('actions_id')->references('id')->on('actions')->onDelete('Cascade');
            $table->string('title');
            $table->boolean('effective')->default(false);
            $table->unsignedBigInteger('problem_type');
            $table->foreign('problem_type')->references('id')->on('problems')->onDelete('Cascade');
            $table->integer('weight');
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
        Schema::dropIfExists('problems');
    }
}
