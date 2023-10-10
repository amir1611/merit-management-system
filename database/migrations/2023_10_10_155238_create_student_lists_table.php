<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentListsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_lists', function (Blueprint $table) {
            $table->id();
            $table->string('college_code')->nullable();
            $table->string('hostel_code')->nullable();
            $table->string('dorm_code')->nullable();
            $table->string('student_id')->nullable();
            $table->string('student_name')->nullable();
            $table->integer('points')->default(0); // Add a points column for storing points
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_lists');
    }
}
