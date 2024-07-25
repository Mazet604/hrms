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
        Schema::create('philhealthinfo', function (Blueprint $table) {
            $table->increments('phl_count');  
            $table->string('empid', 7);
            $table->string('phlid', 20);
            $table->string('phlstat', 200);
            $table->decimal('phlcom', 10,2);
            $table->decimal('phlmem', 10,2);
            $table->decimal('phlemp', 10,2);
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
        Schema::dropIfExists('philhealthinfo');
    }
};
