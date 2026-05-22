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
        Schema::create('screenings', function (Blueprint $table) {
            $table->id();
    //WHICH VISIT THIS SCREENING BELONGS TO
            $table->foreignId('visit_id')
            ->constrained()->onDelete('cascade');
    //WHICH STAFF NURSE DID THE SCREENING
              $table->foreignId('user_id')->constrained()
              ->onDelete('cascade');
    //GENERAL VITALS
              $table->unsignedInteger('temperature')->nullable();
              $table->unsignedInteger('blood_pressure')->nullable();
              $table->unsignedInteger('weight')->nullable();
              $table->unsignedInteger('pulse_rate')->nullable();

    //PRIORITY LEVELS  
               $table->enum('priority_level', [
                'NORMAL',           
                'HIGH',
                'EMERGENCY'
                ])->default('NORMAL');
        //PEDIATRIC- CHILDREN UNDER 5
                  $table->string('height')->nullable();
        //SCREENING DETAILS
                  $table->text('notes')->nullable();
        //REFERRAL TO DOCTOR           
                    $table->boolean('referred_to_doctor')
                    ->default(false);
                  $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('screenings');
    }
};
