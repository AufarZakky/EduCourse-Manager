<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            ['name' => 'Laravel Mastery', 'description' => 'Belajar Laravel dari dasar hingga mahir', 'price' => 500000, 'status' => 'active'],
            ['name' => 'React for Beginners', 'description' => 'Pengenalan React untuk pemula', 'price' => 400000, 'status' => 'active'],
            ['name' => 'Data Science Basics', 'description' => 'Dasar-dasar Data Science menggunakan Python', 'price' => 600000, 'status' => 'active'],
            ['name' => 'Fullstack Development', 'description' => 'Belajar fullstack development dengan Laravel dan Vue', 'price' => 700000, 'status' => 'active'],
            ['name' => 'UI/UX Design', 'description' => 'Dasar-dasar desain UI/UX untuk aplikasi web dan mobile', 'price' => 300000, 'status' => 'active'],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
