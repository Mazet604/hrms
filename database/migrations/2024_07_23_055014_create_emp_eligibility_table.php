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
        Schema::create('emp_eligibility', function (Blueprint $table) {
            $table->increments('eli_count');  
            $table->string('empid', 7);  
            $table->string('eli_service', 35);  
            $table->decimal('eli_rating', 3,2); 
            $table->date('eli_doe'); 
            $table->string('eli_poe', 100); 
            $table->string('eli_license_no', 35);
            $table->date('eli_licen_valid'); 
            $table->timestamps();  // Add timestamps for created_at and updated_at

            // Define foreign key constraint with onDelete and onUpdate actions
            $table->foreign('empid')
                  ->references('empid')
                  ->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emp_eligibiliy');
    }
};
