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
            $table->unsignedBigInteger('representative_id')->nullable();
            $table->foreign('representative_id')->references('id')->on('users')->cascadeOnDelete();
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->foreign('doctor_id')->references('id')->on('doctors')->cascadeOnDelete();
            $table->text('location')->nullable();
            $table->text('notes')->nullable();
            $table->datetime('actual_date')->nullable();
            $table->datetime('expected_date');
            $table->enum('status',['pending','done','deleted'])->default('pending');
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
        Schema::dropIfExists('appointments');
    }
}
