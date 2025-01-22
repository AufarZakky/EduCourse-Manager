<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'status',
        'student_count',
    ];
    
    public function students()
    {
        return $this->hasMany(Transaction::class, 'course_id')->where('payment_status', 'paid');
    }
    
}

