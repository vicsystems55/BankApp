<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchingBonusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matching_bonuses', function (Blueprint $table) {
            $table->id();
            $table->string('main');
            $table->string('left_leg')->nullable();
            $table->string('right_leg')->nullable();
            $table->integer('points')->default();
            
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
        Schema::dropIfExists('matching_bonuses');
    }
}
