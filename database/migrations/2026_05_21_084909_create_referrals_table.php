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
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained()->onDelete('cascade');
        //who referred the patient
            $table->foreignId('referred_by')->constrained('users')->onDelete('cascade');
        //referral type
            $table->enum('referral_type', [
                'DOCTOR',
                'HOSPITAL'
            ]);
        //REFERRAL DETAILS 
             $table->text('reason');
             $table->string('hospital_name')->nullable();
             $table->text('referral_notes')->nullable();
        //STATUS
            $table->enum('status', [
                'PENDING',
                'REVIEWED',
                'COMPLETED'
            ])->default('PENDING');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referrals');
    }
};
