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
        Schema::create('emp_work', function (Blueprint $table) {
            $table->increments('work_count');  
            $table->string('empid', 7);  
            $table->date('workfr');  
            $table->date('workto');  
            $table->string('work_pos', 45); 
            $table->string('work_dept', 45); 
            $table->decimal('work_salary', 10,2);
            $table->integer('work_salarygrade'); 
            $table->string('work_stat', 35); 
            $table->string('work_gov', 5);
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
        Schema::dropIfExists('emp_work');
    }
};
