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
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->string('student_id');
            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');
            $table->string('teacher_id');
            $table->foreign('teacher_id')->references('employee_id')->on('teachers')->onDelete('cascade');
            $table->decimal('marks', 5, 2);
            $table->string('grade_letter')->nullable();
            $table->text('remarks')->nullable();
            $table->date('grading_date');
            $table->string('academic_term');
            $table->string('academic_year');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
