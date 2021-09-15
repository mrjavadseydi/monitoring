<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTotalReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("total_reports", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("category_id");
            $table
                ->foreign("category_id")
                ->references("id")
                ->on("categories")
                ->onDelete("cascade");
            $table->integer("year");
            $table->integer("h_value");
            $table->integer("c_value");
            $table->double("result");
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
        Schema::dropIfExists("total_reports");
    }
}
