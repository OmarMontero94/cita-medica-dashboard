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
        Schema::create('hospitals_medics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medic_id');
            $table->unsignedBigInteger('hospital_id');
            $table->foreign('medic_id')->references('id')->on('medics')
                ->noActionOnDelete()
                ->noActionOnUpdate();
            $table->foreign('hospital_id')->references('id')->on('hospitals')
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
        Schema::dropIfExists('hospitals_medics');
    }
};
