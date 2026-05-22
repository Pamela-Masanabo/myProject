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
        Schema::create('patients', function (Blueprint $table) {
        $table->id();
        $table->string('first_name');
        $table->string('last_name');
        $table->string('phone')->nullable();
        $table->string('id_number')->unique();
        $table->date('date_of_birth');
        $table->unsignedInteger('age')->nullable();
        $table->enum('gender', [
            'MALE',
            'FEMALE',
            'OTHER']);
        $table->enum('race',[
            'BLACK',
            'COLOURED',
            'WHITE']);        
        $table->text('address')->nullable();
        $table->string('city')->nullable();
        $table->unsignedBigInteger('code')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
