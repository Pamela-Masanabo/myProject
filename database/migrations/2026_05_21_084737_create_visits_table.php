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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
           $table->enum('reason',[
                'GENERAL_CONSULTATION',
                'CHRONIC_MEDICATION',
                'PEDIATRIC_CARE',
                'MATERNITY',]);              
            $table->text('notes')->nullable();

            //SYSTEM FLOW - STATUS
            $table->enum('status', [
                'CHECKED_IN',
                'WAITING_SCREENING',
                'IN_SCREENING',
                'WAITING_CONSULTATION',
                'IN_CONSULTATION',
                'REFERRED',
                'WAITING_DOCTOR',
                'COMPLETED',
                'LEFT',
                'RETURNED'
            ])->default('CHECKED_IN'); 
            $table->string('queue_number')->nullable();    
           
            // GUARDIAN INFO
            $table->string('guardian_name')->nullable();
            $table->enum('guardian_relationship', [
                'MOTHER',
                'FATHER',
                'GRANDPARENT',
                'GUARDIAN',              
            ])->nullable();
            $table->string('guardian_contact')->nullable();

            //ELDERLY PATIENTS
            $table->boolean('is_elderly')
            ->default(false);
            $table->timestamps();
        });
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
