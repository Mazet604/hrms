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
        Schema::create('emp_address2', function (Blueprint $table) {
            $table->increments('add2_count');  
            $table->unsignedInteger('emp_count');  
            $table->string('emp_house2',20);
            $table->string('emp_street2',20);
            $table->string('emp_subd2',30); //30 for subdivisions with high character count
            $table->string('emp_brgy2',20);
            $table->string('emp_city2',20);
            $table->string('emp_prov2',20);
            $table->string('emp_region2',20);
            $table->date('emp_datereg2');
            $table->string('emp_pob2',20);
            $table->string('emp_zip2s',6);
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
        Schema::dropIfExists('emp_address2');
    }
};
