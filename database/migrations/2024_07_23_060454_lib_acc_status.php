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
        Schema::create('lib_acc_status', function (Blueprint $table) {
            $table->increments('lib_count');  
            $table->string('lib_stat', 35);  
            $table->string('lib_desc', 35);  
            $table->string('educ_school', 100); 
            $table->string('educ_degree', 35); 
            $table->date('educ_from'); 
            $table->integer('educ_year_grad');
            $table->string('educ_academic_honor', 35)->nullable();  
            $table->string('educ_hl_earned', 35)->nullable(); 
            $table->timestamps();  // Add timestamps for created_at and updated_a
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lib_acc_status');
    }
};
