<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_teachers', function (Blueprint $table) {
            $table->id();
            $table->integer('t_id')->unsigned();
            $table->integer('tc_term')->unsigned();
            $table->integer('tc_year')->unsigned();
            $table->string('tc_a1', 150)->nullable();
            $table->string('tc_a2', 150)->nullable();
            $table->string('tc_a3', 150)->nullable();
            $table->string('tc_a4', 150)->nullable();
            $table->string('tc_a5', 150)->nullable();
            $table->string('tc_a6', 150)->nullable();
            $table->string('tc_a7', 150)->nullable();
            $table->string('tc_a8', 150)->nullable();
            $table->string('tc_a9', 150)->nullable();
            
            $table->string('tc_b1', 150)->nullable();
            $table->string('tc_b2', 150)->nullable();
            $table->string('tc_b3', 150)->nullable();
            $table->string('tc_b4', 150)->nullable();
            $table->string('tc_b5', 150)->nullable();
            $table->string('tc_b6', 150)->nullable();
            $table->string('tc_b7', 150)->nullable();
            $table->string('tc_b8', 150)->nullable();
            $table->string('tc_b9', 150)->nullable();

            $table->string('tc_c1', 150)->nullable();
            $table->string('tc_c2', 150)->nullable();
            $table->string('tc_c3', 150)->nullable();
            $table->string('tc_c4', 150)->nullable();
            $table->string('tc_c5', 150)->nullable();
            $table->string('tc_c6', 150)->nullable();
            $table->string('tc_c7', 150)->nullable();
            $table->string('tc_c8', 150)->nullable();
            $table->string('tc_c9', 150)->nullable();

            $table->string('tc_d1', 150)->nullable();
            $table->string('tc_d2', 150)->nullable();
            $table->string('tc_d3', 150)->nullable();
            $table->string('tc_d4', 150)->nullable();
            $table->string('tc_d5', 150)->nullable();
            $table->string('tc_d6', 150)->nullable();
            $table->string('tc_d7', 150)->nullable();
            $table->string('tc_d8', 150)->nullable();
            $table->string('tc_d9', 150)->nullable();

            $table->string('tc_e1', 150)->nullable();
            $table->string('tc_e2', 150)->nullable();
            $table->string('tc_e3', 150)->nullable();
            $table->string('tc_e4', 150)->nullable();
            $table->string('tc_e5', 150)->nullable();
            $table->string('tc_e6', 150)->nullable();
            $table->string('tc_e7', 150)->nullable();
            $table->string('tc_e8', 150)->nullable();
            $table->string('tc_e9', 150)->nullable();
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
        Schema::dropIfExists('schedule_teachers');
    }
};
