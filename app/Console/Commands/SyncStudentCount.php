<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Course;

class SyncStudentCount extends Command
{
    protected $signature = 'sync:student-count';
    protected $description = 'Sync student count for all courses';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        Course::all()->each(function ($course) {
            $count = $course->students()->count();
            $course->update(['student_count' => $count]); 
        });

        $this->info('Student count synced successfully!');
    }
}
