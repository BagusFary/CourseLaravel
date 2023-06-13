<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';
    protected $guarded = ['id'];

    public function orders()
    {
        return $this->hasMany(Order::class, 'course_id', 'id');
    }

    public function videos()
    {
        return $this->hasMany(Video::class, 'course_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'course_tag', 'course_id', 'tag_id');
    }


}
