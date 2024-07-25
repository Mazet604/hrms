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
        Schema::create('emp_voluntary', function (Blueprint $table) {
            $table->increments('vol_count');  
            $table->string('empid', 7);  
            $table->string('vol_name', 35);  
            $table->string('vol_add', 35);  
            $table->date('vol_fr'); 
            $table->date('vol_to'); 
            $table->integer('vol_hrs');
            $table->string('vol_pos', 35); 
            $table->timestamps();  // Add timestamps for created_at and updated_at

            // Define foreign key constraint with onDelete and onUpdate actions
            $table->foreign('empid')
                  ->references('empid')
                  ->on('users')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emp_voluntary');
    }
};
