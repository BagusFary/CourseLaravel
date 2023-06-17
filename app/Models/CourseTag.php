<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseTag extends Model
{
    use HasFactory;
    protected $table = 'course_tag';
    protected $guarded = ['id'];


    public function tags()
    {
        return $this->hasMany(Tags::class, 'tag_id', 'id');
    }
}


