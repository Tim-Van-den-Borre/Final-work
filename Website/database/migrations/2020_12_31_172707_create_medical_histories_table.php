<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patientID');
            $table->unsignedBigInteger('doctorID');
            $table->unsignedBigInteger('appointmentID');
            $table->string('condition');
            $table->date('date');
            $table->timestamps();

            $table->foreign('patientID')->references('id')->on('users');
            $table->foreign('doctorID')->references('id')->on('users')->where('role', 'Doctor');
            $table->foreign('appointmentID')->references('id')->on('appointments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_histories');
    }
}
