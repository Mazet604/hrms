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
        Schema::create('emp_father', function (Blueprint $table) {
            $table->increments('father_count');  
            $table->unsignedInteger('emp_count'); 
            $table->string('father_fname',35);
            $table->string('father_mname',35);
            $table->string('father_lname',35);
            $table->string('father_xname',10);
            $table->timestamps();  // Add timestamps for created_at and updated_ats

            // Define foreign key constraint
            $table->foreign('emp_count')
            ->references('emp_count')
            ->on('employee')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emp_father');
    }
};
