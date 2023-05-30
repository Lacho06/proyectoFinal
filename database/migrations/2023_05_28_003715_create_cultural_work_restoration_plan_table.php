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
        Schema::create('cultural_work_restoration_plan', function (Blueprint $table) {
            $table->id();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->unsignedBigInteger('cultural_work_id');
            $table->unsignedBigInteger('restoration_plan_id');
            $table->foreign('cultural_work_id')->references('id')->on('cultural_works')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('cultural_work_restoration_plan');
    }
};
