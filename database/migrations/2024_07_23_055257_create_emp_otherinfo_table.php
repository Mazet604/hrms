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
        Schema::create('emp_otherinfo', function (Blueprint $table) {
            $table->increments('other_count');  
            $table->string('empid',7);
            $table->string('other_34a',5);
            $table->string('other_34b',5);
            $table->string('other_34bif',35);
            $table->string('other_35a',5);
            $table->string('other_35aif',35);
            $table->string('other_35b',5);
            $table->string('other_35bif',35);
            $table->date('other_35bfiled');
            $table->string('other_35stat',35);
            $table->string('other_36',5);
            $table->string('other_36if',35);
            $table->string('other_37',5);
            $table->string('other_37if',35);
            $table->string('other_38a',5);
            $table->string('other_38aif',35);
            $table->string('other_38b',5);
            $table->string('other_39',5);
            $table->string('other_39if',35);
            $table->string('other_40a',5);
            $table->string('other_40aif',35);
            $table->string('other_40b',5);
            $table->string('other_40bif',35);
            $table->string('other_40c',5);
            $table->string('other_40cif',35);
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
        Schema::dropIfExists('emp_otherinfo');
    }
};
