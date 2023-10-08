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
        Schema::create('projectestimationsubitems', function (Blueprint $table) {
            $table->smallInteger("project_id")->refrences("id")->on("project");
            $table->smallInteger("activities_id")->refrences("id")->on("activities");
            $table->bigInteger('qty');
            $table->bigInteger('rate');
            $table->string("tCode");
            $table->bigInteger('activity_id');
            $table->tinyInteger('cancel')->default(0);
            $table->tinyInteger('is_estimated')->default(0); //0=estimatation 1=progress
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
        Schema::dropIfExists('projectestimationsubitems');
    }
};
