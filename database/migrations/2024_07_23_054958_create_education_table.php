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
        Schema::create('education', function (Blueprint $table) {
            $table->increments('educ_count');  
            $table->string('empid', 7);  
            $table->unsignedInteger('educ_level');  
            $table->string('educ_school', 100); 
            $table->string('educ_degree', 35); 
            $table->date('educ_from'); 
            $table->integer('educ_year_grad');
            $table->string('educ_academic_honor', 35)->nullable();  
            $table->string('educ_hl_earned', 35)->nullable(); 
            $table->timestamps();  // Add timestamps for created_at and updated_at

            // Define foreign key constraint with onDelete and onUpdate actions
            $table->foreign('empid')
                  ->references('empid')
                  ->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('educ_level')
                  ->references('lvl_count')
                  ->on('education_level')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education');
    }
};