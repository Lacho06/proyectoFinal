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
        Schema::create('cultural_works', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('year_of_stablishment');
            $table->string('restore_permission');
            $table->string('location');
            $table->longText('review');
            $table->string('state_of_disrepair');
            $table->string('budget');
            $table->unsignedBigInteger('author_id')->nullable();
            $table->unsignedBigInteger('restoration_plan_id')->nullable();
            $table->foreign('author_id')->references('id')->on('authors')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('restoration_plan_id')->references('id')->on('restoration_plans')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('cultural_works');
    }
};
