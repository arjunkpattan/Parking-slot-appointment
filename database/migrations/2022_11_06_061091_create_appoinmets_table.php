<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppoinmetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appoinmets', function (Blueprint $table) {
            $table->id();
            $table->string('appoinment_id');
            $table->dateTime('appoinment_start');
            $table->dateTime('appoinment_end');
            $table->unsignedbiginteger('user_id'); 
            $table->foreign('user_id')->references('id')->on('users'); 
            $table->unsignedbiginteger('slot_id'); 
            $table->string('vehicle_number');
            $table->foreign('slot_id')->references('id')->on('parking_slots'); 
            $table->string('amount');
            $table->string('hours');
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
        Schema::dropIfExists('appoinmets');
    }
}
