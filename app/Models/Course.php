<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public function orders()
    {
        return $this->hasMany(Order::class, 'course_id', 'id');
    }

    public function courseTag()
    {
        return $this->hasMany(CourseTag::class, 'course_id', 'id');
    }

    public function videos()
    {
        return $this->hasMany(Video::class, 'course_id', 'id');
    }
}
