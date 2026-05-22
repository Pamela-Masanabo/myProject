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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
           
            //CONSULTATION DETAILS
            $table->text('diagnosis')->nullable();
            $table->text('medication')->nullable();
            $table->text('dosage_instructions')->nullable(); 
            $table->text('notes')->nullable();
           //follow up details
            $table->date('next_visit_date')->nullable();
            //referal details
            $table->boolean('referred_to_doctor')->default(false);
            $table->boolean('hospital_referral')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
