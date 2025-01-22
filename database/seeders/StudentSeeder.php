<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;


class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $students = [
            ['student_name' => 'Ivan Kolev', 'course_id' => 1, 'enrollment_date' => now(), 'payment_status' => 'paid'],
            ['student_name' => 'Leo Messi', 'course_id' => 1, 'enrollment_date' => now(), 'payment_status' => 'paid'],
            ['student_name' => 'Raja Manggala', 'course_id' => 2, 'enrollment_date' => now(), 'payment_status' => 'paid'],
            ['student_name' => 'Bob Marley', 'course_id' => 2, 'enrollment_date' => now(), 'payment_status' => 'paid'],
            ['student_name' => 'Ahmad Kasim', 'course_id' => 3, 'enrollment_date' => now(), 'payment_status' => 'paid'],
            ['student_name' => 'Zulkarnain', 'course_id' => 3, 'enrollment_date' => now(), 'payment_status' => 'paid'],
            ['student_name' => 'Dika Satria', 'course_id' => 4, 'enrollment_date' => now(), 'payment_status' => 'paid'],
            ['student_name' => 'Dani Dana', 'course_id' => 4, 'enrollment_date' => now(), 'payment_status' => 'paid'],
            ['student_name' => 'Saputra Ari', 'course_id' => 5, 'enrollment_date' => now(), 'payment_status' => 'paid'],
            ['student_name' => 'Faturrahman', 'course_id' => 5, 'enrollment_date' => now(), 'payment_status' => 'paid'],
        ];

        foreach ($students as $student) {
            Transaction::create($student);
        }
    }
}
