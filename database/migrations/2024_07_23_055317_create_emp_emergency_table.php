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
        Schema::create('emp_emergency', function (Blueprint $table) {
            $table->increments('emer_count');
            $table->unsignedInteger('emp_count'); //unsigned integer since increment reference must not be negative
            $table->string('emer_fname',35);
            $table->string('emer_mname',35);
            $table->string('emer_lname',35);
            $table->string('emer_xname',10);
            $table->integer('emer_cnum');
            $table->timestamps();  // Add timestamps for created_at and updated_at

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
        Schema::dropIfExists('emp_emergency');
    }
};
