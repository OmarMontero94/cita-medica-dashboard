<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dates', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->dateTime('date');
            $table->unsignedBigInteger('medic_id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('service_id');
            $table->foreign('medic_id')->references('id')->on('medics')
                ->noActionOnDelete()
                ->noActionOnUpdate();
            $table->foreign('patient_id')->references('id')->on('medics')
                ->noActionOnDelete()
                ->noActionOnUpdate();
            $table->foreign('service_id')->references('id')->on('medics')
                ->noActionOnDelete()
                ->noActionOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dates');
    }
};
