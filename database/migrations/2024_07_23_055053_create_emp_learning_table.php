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
        Schema::create('emp_learning', function (Blueprint $table) {
            $table->increments('learn_count');  
            $table->string('empid', 7);  
            $table->string('learn_title', 35);  
            $table->date('learn_fr');
            $table->date('learn_to');
            $table->integer('learn_hrs');
            $table->string('learn_type', 35);  
            $table->string('learn_con', 45); 
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
        Schema::dropIfExists('emp_learning');
    }
};
