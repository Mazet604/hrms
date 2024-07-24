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
        Schema::create('employee', function (Blueprint $table) {
            $table->increments('emp_count');  
            $table->string('empid',7);
            $table->string('emp_fname',35);
            $table->string('emp_mname',35);
            $table->string('emp_lname',35);
            $table->string('emp_ext',10);
            $table->date('emp_dob');
            $table->string('emps_ex',10);
            $table->string('emp_blood',10);
            $table->decimal('emp_height',3,2);
            $table->integer('emp_weight');
            $table->integer('emp_cnum');
            $table->string('emp_email',35);
            $table->string('emp_idlicense',35);
            $table->string('emp_idplace',35);
            $table->string('emp_iduse',35);
            $table->date('emp_iddate');
            $table->integer('emp_telnum');
            $table->string('emp_religion',35);
            $table->integer('empage');
            $table->integer('User_type');
            $table->string('other_40b',5);
            $table->string('esignature',35);//accepts pdf,png,jpeg only
            $table->string('emp_disability',5);//yes or no if no fill up in emp_pwd
            $table->string('emp_ip',5); //yes or no if no fill up in emp_ip_group
            $table->string('emp_pwd',35);
            $table->string('emp_ip_group',35);
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
        Schema::dropIfExists('employee');
    }
};
