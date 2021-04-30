<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patientID');
            $table->unsignedBigInteger('doctorID');
            $table->string('reason', 100);
            $table->datetime('startDate');
            $table->datetime('endDate');
            $table->timestamps();

            $table->foreign('patientID')->references('id')->on('users');
            $table->foreign('doctorID')->references('id')->on('users')->where('role', 'Doctor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
