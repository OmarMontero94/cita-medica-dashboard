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
        Schema::create('medics_services', function( Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('medic_id');
            $table->unsignedBigInteger('service_id');
            $table->foreign('medic_id')->references('id')->on('medics')
                ->noActionOnDelete()
                ->noActionOnUpdate();
            $table->foreign('service_id')->references('id')->on('services')
                ->noActionOnDelete()
                ->noActionOnUpdate();
            $table->float('price');
            $table->timestamps();
        });

        Schema::table('medics', function (Blueprint $table) {
            $table->foreign('location_id')->references('id')->on('locations')
                ->noActionOnDelete()
                ->noActionOnUpdate();

            $table->foreign('specialty_id')->references('id')->on('specialties')
                ->noActionOnDelete()
                ->noActionOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medics_services');
    }
};
