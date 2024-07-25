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
        Schema::create('emp_child', function (Blueprint $table) {
            $table->increments('child_count');
            $table->unsignedInteger('emp_count');
            $table->string('child_fname',35);   
            $table->string('child_mname',35);
            $table->string('child_lname',35);
            $table->string('child_xname',35);
            $table->date('child_dob');
            $table->timestamps();  // Add timestamps for created_at and updated_at

            // Define foreign key constraint
            $table->foreign('emp_count')
            ->references('emp_count')
            ->on('employee')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emp_child');
    }
};
