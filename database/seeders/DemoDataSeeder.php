<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        //temporarily disable the seeder
        // Create Super Admin User
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password123'),
        ]);

        // Create Teacher Users
        $teacherUser1 = User::create([
            'name' => 'Test Teacher 1',
            'email' => 'teacher@example.com',
            'password' => Hash::make('password123'),
        ]);
        $teacherUser1->assignRole('Teacher');

        $teacherUser2 = User::create([
            'name' => 'Test Teacher 2',
            'email' => 'teacher2@example.com',
            'password' => Hash::make('password123'),
        ]);
        $teacherUser2->assignRole('Teacher');

        // Create Student Users
        $studentUser1 = User::create([
            'name' => 'Test Student 1',
            'email' => 'student@example.com',
            'password' => Hash::make('password123'),
        ]);
        $studentUser1->assignRole('Student');

        $studentUser2 = User::create([
            'name' => 'Test Student 2',
            'email' => 'student2@example.com',
            'password' => Hash::make('password123'),
        ]);
        $studentUser2->assignRole('Student');

        // Create Teachers
        $mathTeacher = Teacher::create([
            'user_id' => $teacherUser1->id,
            'employee_id' => 'T001',
            'first_name' => 'Test',
            'last_name' => 'Teacher 1',
            'gender' => 'male',
            'date_of_birth' => '1985-01-15',
            'phone' => '1234567890',
            'address' => '123 Teacher Street',
            'joining_date' => '2023-01-01',
        ]);

        $scienceTeacher = Teacher::create([
            'user_id' => $teacherUser2->id,
            'employee_id' => 'T002',
            'first_name' => 'Test',
            'last_name' => 'Teacher 2',
            'gender' => 'female',
            'date_of_birth' => '1988-03-20',
            'phone' => '0987654321',
            'address' => '456 Teacher Avenue',
            'joining_date' => '2023-01-01',
        ]);

        // Create Students
        $student1 = Student::create([
            'user_id' => $studentUser1->id,
            'student_id' => 'S001',
            'first_name' => 'Test',
            'last_name' => 'Student 1',
            'gender' => 'male',
            'date_of_birth' => '2005-05-10',
            'admission_date' => '2023-01-01',
            'current_grade_level' => 'Grade 10',
            'phone' => '1122334455',
            'address' => '789 Student Lane',
            'parent_name' => 'Test Parent 1',
            'parent_phone' => '5544332211',
            'parent_email' => 'parent1@example.com',
        ]);

        $student2 = Student::create([
            'user_id' => $studentUser2->id,
            'student_id' => 'S002',
            'first_name' => 'Test',
            'last_name' => 'Student 2',
            'gender' => 'female',
            'date_of_birth' => '2005-07-15',
            'admission_date' => '2023-01-01',
            'current_grade_level' => 'Grade 10',
            'phone' => '9988776655',
            'address' => '321 Student Road',
            'parent_name' => 'Test Parent 2',
            'parent_phone' => '1122334455',
            'parent_email' => 'parent2@example.com',
        ]);

        // Create Subjects
        $mathematics = Subject::create([
            'name' => 'Mathematics',
            'code' => 'MATH101',
            'grade_level' => 'Grade 10',
            'credits' => 1,
            'description' => 'Basic mathematics including algebra, geometry, and trigonometry',
        ]);

        $science = Subject::create([
            'name' => 'Science',
            'code' => 'SCI101',
            'grade_level' => 'Grade 10',
            'credits' => 1,
            'description' => 'General science including physics, chemistry, and biology',
        ]);

        // Create Grades
        // Math grades for Student 1
        Grade::create([
            'student_id' => $student1->id,
            'subject_id' => $mathematics->id,
            'teacher_id' => $mathTeacher->id,
            'marks' => 85,
            'grade_letter' => 'A',
            'academic_term' => 'Term 1',
            'academic_year' => '2024',
            'grading_date' => '2024-03-01',
            'remarks' => 'Good performance in mathematics',
        ]);

        Grade::create([
            'student_id' => $student1->id,
            'subject_id' => $science->id,
            'teacher_id' => $scienceTeacher->id,
            'marks' => 78,
            'grade_letter' => 'B+',
            'academic_term' => 'Term 1',
            'academic_year' => '2024',
            'grading_date' => '2024-03-01',
            'remarks' => 'Good understanding of science concepts',
        ]);

        // Grades for Student 2
        Grade::create([
            'student_id' => $student2->id,
            'subject_id' => $mathematics->id,
            'teacher_id' => $mathTeacher->id,
            'marks' => 92,
            'grade_letter' => 'A+',
            'academic_term' => 'Term 1',
            'academic_year' => '2024',
            'grading_date' => '2024-03-01',
            'remarks' => 'Excellent performance in mathematics',
        ]);

        Grade::create([
            'student_id' => $student2->id,
            'subject_id' => $science->id,
            'teacher_id' => $scienceTeacher->id,
            'marks' => 88,
            'grade_letter' => 'A',
            'academic_term' => 'Term 1',
            'academic_year' => '2024',
            'grading_date' => '2024-03-01',
            'remarks' => 'Very good understanding of science',
        ]);
    }
} 