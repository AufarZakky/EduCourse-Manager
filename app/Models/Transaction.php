<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transaction';


    protected $fillable = [
        'student_name',
        'course_id',
        'enrollment_date',
        'payment_status',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    protected static function booted()
    {
        static::created(function ($transaction) {
            if ($transaction->payment_status === 'paid') {
                $transaction->course->increment('student_count');
            }
        });
    
        static::updated(function ($transaction) {
            if ($transaction->wasChanged('payment_status')) {
                // Jika status "paid"
                if ($transaction->payment_status === 'paid') {
                    $transaction->course->increment('student_count');
                }
                else {
                    $transaction->course->decrement('student_count');
                }
            }
        });
    
        static::deleted(function ($transaction) {
            if ($transaction->payment_status === 'paid') {
                $transaction->course->decrement('student_count');
            }
        });
    }
    

}
