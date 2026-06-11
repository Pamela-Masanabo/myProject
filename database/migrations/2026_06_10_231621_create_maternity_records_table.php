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
        Schema::create('maternity_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->date('lmp_date'); //Last Menstrual Period
            $table->date('edd_date')->nullable(); //Estimated Due Date
            $table->date('enrollment_date')->nullable();    
            $table->unsignedTinyInteger('pregnancy_number')->nullable();
            $table->boolean('high_risk')->default(false);   
            $table->enum('status', [
            'ACTIVE', 
            'COMPLETED', 
            'TRANSFERRED'])->default('ACTIVE');    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maternity_records');
    }
};
